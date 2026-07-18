import os
from dotenv import load_dotenv
from app import app, db, User

load_dotenv()

def ensure_admin():
    admin_username = os.getenv('ADMIN_USERNAME')
    admin_password = os.getenv('ADMIN_PASSWORD')

    if not admin_username or not admin_password:
        print('Missing ADMIN_USERNAME or ADMIN_PASSWORD in environment')
        return

    with app.app_context():
        user = User.query.filter_by(username=admin_username).first()
        if user:
            user.set_password(admin_password)
            user.is_admin = True
            db.session.commit()
            print(f'Admin "{admin_username}" updated successfully')
        else:
            user = User(username=admin_username, is_admin=True)
            user.set_password(admin_password)
            db.session.add(user)
            db.session.commit()
            print(f'Admin "{admin_username}" created successfully')

if __name__ == '__main__':
    ensure_admin()
