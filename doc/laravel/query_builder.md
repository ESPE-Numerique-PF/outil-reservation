# Query Builder

## Retrieving results

### All rows from a table
```php
$users = DB::table('users')->get(); // fetch results

foreach ($users as $user) {
    echo $user->name;
}
```

### Retrieve a single row / column from a table
The `first` method returns the first result.\
The `value` method returns a single value from a record.\
The `find` method returns a single row from the `id` column value.
```php
// extract the first result
$user = DB::table('users')->where('name', 'John')->first();

echo $user->name;

// extract a single value from a record
$email = DB::table('users')
    ->where('name', 'John')
    ->value('email');

// extract a single row by its id
$user = DB::table('users')->find(4);

```

### Retrieve a list of column values

The `pluck` method returns a collection containing the values of a single column.

```php
$titles = DB::table('roles')->pluck('title');

foreach ($titles as $title) {
    echo $title;
}
```
