<h1>add a new group</h1>

<form action="/groups" method="POST">
@csrf
    <label for="group-name">Name</label>
    <input id="group-name" type="text" name="name">

<button>submit</button>
</form>
