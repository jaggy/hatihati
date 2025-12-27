hello world
<h1>hatihati</h1>
<a href="/groups/create">Add a new group</a>

<div>
    @foreach($groups as $group)
        {{ $group->name }}
    @endforeach
</div>
