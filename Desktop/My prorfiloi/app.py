from flask import Flask, render_template, request, jsonify, flash, send_file, redirect, url_for
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime
from flask_admin import Admin
from flask_admin.contrib.sqla import ModelView
from flask_admin.menu import MenuLink
from flask_login import LoginManager, UserMixin, login_user, login_required, logout_user, current_user
from werkzeug.security import generate_password_hash, check_password_hash
from flask_mail import Mail, Message
from flask_migrate import Migrate
from flask_compress import Compress
import os

app = Flask(__name__)
# Enable response compression for better performance
compress = Compress(app)

# Load environment variables
from dotenv import load_dotenv
load_dotenv()

# Ensure instance directory exists and configure SQLAlchemy
db_url = os.getenv('DATABASE_URL', 'sqlite:///portfolio.db')
if db_url.startswith('sqlite:///'):
    rel_path = db_url.replace('sqlite:///', '')
    if not os.path.isabs(rel_path):
        abs_path = os.path.join(app.root_path, rel_path)
        os.makedirs(os.path.dirname(abs_path), exist_ok=True)
        db_url = 'sqlite:///' + abs_path.replace('\\', '/')
app.config['SQLALCHEMY_DATABASE_URI'] = db_url
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

# Configure Flask-Mail
app.config['MAIL_SERVER'] = os.getenv('MAIL_SERVER', 'smtp.gmail.com')
app.config['MAIL_PORT'] = int(os.getenv('MAIL_PORT', 587))
app.config['MAIL_USE_TLS'] = os.getenv('MAIL_USE_TLS', 'True').lower() == 'true'
app.config['MAIL_USERNAME'] = os.getenv('MAIL_USERNAME')
app.config['MAIL_PASSWORD'] = os.getenv('MAIL_PASSWORD')
app.config['MAIL_DEFAULT_SENDER'] = os.getenv('MAIL_DEFAULT_SENDER')

# Secret key
app.secret_key = os.getenv('SECRET_KEY')

# Ensure required environment variables are set
required_env_vars = ['MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_DEFAULT_SENDER', 'SECRET_KEY']
for var in required_env_vars:
    if not os.getenv(var):
        raise ValueError(f'Missing required environment variable: {var}')

db = SQLAlchemy(app)
migrate = Migrate(app, db)
mail = Mail(app)
login_manager = LoginManager(app)
login_manager.login_view = 'login'
admin = Admin(app, name='Portfolio Admin', template_mode='bootstrap3')
admin.add_link(MenuLink(name='Main Home', url='/'))

# Models
class User(UserMixin, db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password_hash = db.Column(db.String(120), nullable=False)
    is_admin = db.Column(db.Boolean, default=False)

    def set_password(self, password):
        self.password_hash = generate_password_hash(password)

    def check_password(self, password):
        return check_password_hash(self.password_hash, password)

@login_manager.user_loader
def load_user(user_id):
    return User.query.get(int(user_id))

class Project(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(100), nullable=False)
    description = db.Column(db.Text, nullable=False)
    technologies = db.Column(db.String(200))
    image_url = db.Column(db.String(200))
    project_url = db.Column(db.String(200))
    created_date = db.Column(db.DateTime, default=datetime.utcnow)

class Profile(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    summary = db.Column(db.Text)
    image_url = db.Column(db.String(200))
    updated_date = db.Column(db.DateTime, default=datetime.utcnow)

class Certification(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    level = db.Column(db.String(50))
    image_url = db.Column(db.String(200))
    created_date = db.Column(db.DateTime, default=datetime.utcnow)

class Education(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    institution = db.Column(db.String(200), nullable=False)
    degree = db.Column(db.String(100), nullable=False)
    field_of_study = db.Column(db.String(100))
    start_date = db.Column(db.DateTime)
    end_date = db.Column(db.DateTime)
    grade = db.Column(db.String(20))
    description = db.Column(db.Text)

class Skill(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    category = db.Column(db.String(50))
    proficiency_level = db.Column(db.Integer)
    created_date = db.Column(db.DateTime, default=datetime.utcnow)

# Admin Views
class AdminModelView(ModelView):
    def is_accessible(self):
        return current_user.is_authenticated and current_user.is_admin

admin.add_view(AdminModelView(User, db.session))
admin.add_view(AdminModelView(Project, db.session))
admin.add_view(AdminModelView(Profile, db.session))
admin.add_view(AdminModelView(Certification, db.session))
admin.add_view(AdminModelView(Education, db.session))
admin.add_view(AdminModelView(Skill, db.session))

@app.context_processor
def inject_datetime():
    return {'datetime': datetime}

# Routes
@app.route('/')
def home():
    return render_template('index.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        user = User.query.filter_by(username=username).first()
        
        if user and user.check_password(password):
            login_user(user)
            flash('Logged in successfully.', 'success')
            return redirect(url_for('admin.index'))
        flash('Invalid username or password', 'danger')
    return render_template('login.html')

@app.route('/logout')
@login_required
def logout():
    logout_user()
    flash('Logged out successfully.', 'success')
    return redirect(url_for('home'))

@app.route('/api/projects')
def api_projects():
    projects = Project.query.all()
    return jsonify([{
        'id': p.id,
        'title': p.title,
        'description': p.description,
        'technologies': p.technologies.split(',') if p.technologies else [],
        'image_url': p.image_url,
        'project_url': p.project_url,
        'created_date': p.created_date.isoformat()
    } for p in projects])

@app.route('/projects')
def projects():
    return render_template('projects.html')

@app.route('/games')
def games():
    return render_template('games.html')

@app.route('/download/resume/pdf')
def download_resume_pdf():
    try:
        return send_file(os.path.join(app.root_path, 'Resume Ganesh Mogal-2025.pdf'), as_attachment=True)
    except Exception as e:
        flash('Error downloading PDF resume', 'danger')
        return redirect(url_for('home'))

@app.route('/download/resume/word')
def download_resume_word():
    try:
        return send_file(os.path.join(app.root_path, 'Resume Ganesh Mogal-2025.docx'), as_attachment=True)
    except Exception as e:
        flash('Error downloading Word resume', 'danger')
        return redirect(url_for('home'))

@app.route('/api/profile')
def api_profile():
    profile = Profile.query.first()
    if not profile:
        return jsonify({})
    return jsonify({
        'summary': profile.summary,
        'image_url': profile.image_url
    })

@app.route('/api/certifications')
def api_certifications():
    certifications = Certification.query.all()
    return jsonify([{
        'id': c.id,
        'name': c.name,
        'level': c.level,
        'image_url': c.image_url,
        'created_date': c.created_date.isoformat()
    } for c in certifications])

@app.route('/contact', methods=['POST'])
def contact():
    try:
        name = request.form.get('name')
        email = request.form.get('email')
        subject = request.form.get('subject')
        message = request.form.get('message')

        if not all([name, email, subject, message]):
            flash('All fields are required.', 'danger')
            return redirect(url_for('home') + '#contact')
        
        msg = Message(
            subject=f'Portfolio Contact: {subject}',
            sender=app.config['MAIL_DEFAULT_SENDER'],
            reply_to=email,
            recipients=[app.config['MAIL_DEFAULT_SENDER']],
            body=f"From: {name} <{email}>\n\n{message}"
        )
        mail.send(msg)
        flash('Message sent successfully!', 'success')
    except Exception as e:
        app.logger.error(f'Error sending email: {str(e)}')
        flash('Failed to send message. Please try again later.', 'danger')
    return redirect(url_for('home') + '#contact')

# Utility route to create an admin user for testing
@app.route('/create_admin')
@login_required
def create_admin():
    if not current_user.is_admin:
        flash('Unauthorized access', 'danger')
        return redirect(url_for('home'))
    try:
        admin_username = os.getenv('ADMIN_USERNAME', 'admin')
        admin_password = os.getenv('ADMIN_PASSWORD')
        if not admin_password:
            flash('Admin password not configured', 'danger')
            return redirect(url_for('home'))
            
        existing_user = User.query.filter_by(username=admin_username).first()
        if existing_user:
            flash('Admin user already exists', 'info')
        else:
            user = User(username=admin_username)
            user.set_password(admin_password)
            user.is_admin = True
            db.session.add(user)
            db.session.commit()
            flash('Admin user created successfully', 'success')
    except Exception as e:
        db.session.rollback()
        flash(f'Error creating admin user: {str(e)}', 'danger')
    return redirect(url_for('home'))

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=os.getenv('FLASK_DEBUG', 'False').lower() == 'true')
