@props([
    'title' => 'title',
    'details' => 'details',
    'action' => 'action'
])

<div class="settings-container">
    <div class="details">
        <p class="title">{{$title}}</p>
        <p>{{$details}}</p>
    </div>
    <form class="form-container" action="{{$action}}" method="post"> 
        @csrf
        {{ $form }}
    </form>
</div>