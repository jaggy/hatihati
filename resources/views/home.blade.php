hello world
<h1>hatihati</h1>
<a href="/groups/create">Add a new group</a>

<div>
    @foreach($groups as $group)
       <li>
        <a href="/group/{{$group->id}}">{{ $group->name }}</a>
       </li>
    @endforeach
</div>
