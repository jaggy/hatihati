Hello

<h1>{{$group->name}}</h1>

<form action="/expenses" method="POST">
    @csrf

    <label for="description">Description</label>
    <input id="description" type="text" name="description">

    <label for="amount">Expense</label>
    <input id="amount" type="number" name="amount">

    <button>Add Expense</button>
</form>

