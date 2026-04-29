<h2>User Feedback</h2>

@foreach($feedbacks as $feedback)

<div class="card mb-3">

<h4>{{ $feedback->name }}</h4>

<p>{{ $feedback->message }}</p>

<small>{{ $feedback->created_at }}</small>

</div>

@endforeach