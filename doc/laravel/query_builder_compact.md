# Query Builder

## Retriving results

```php
get() // fetch results of the query
```

Methods that returns `stdClass` object (do not use `get`).

```php
first() // first row
value('f1') // 'f1' value of the first row
find(1) // find by id
pluck('f1') // all values of 'f1'
pluck('f1', 'f2') // all values of 'f1' with 'f2' as key
```

## Chunk
Useful when working with large amount of data.
```php
chunk(100, function($users) {
    // ...
})
```
Stop processing chunks by returning `false`.
```php
chunk(100, function($users) {
    // ...
    return false;
})
```

## Agregate

Call these methods after a query (do not call `get` after)

```php
count() // count nb rows
max('f1') // max value of 'f1'
min('f1')
avg('f1')
sum('f1')

exists() // determine if any records exist (equivalent to 'count > 0')
doesntExist()
```

## Selects

```php
select('f1', 'f2 as o2', ...)
select(...)->distinct()

// if the query is already built
addSelect(...)
```

# Raw expressions

```php
raw('SQL stmt') // exec raw SQL stmt (be careful of SQL injection)
selectRaw('...') // equivalent to addSelect(DB::raw())
whereRaw('...')
orWhereRaw('...')
havingRaw('...')
orHavingRaw('...')
orderBygRaw('...')
groupBygRaw('...')
```

## Joins

```php
join('t2', 't1.id', '=', 't2.fk_id') // join with t2 table (possible to chain)
leftJoin('t2', 't1.id', '=', 't2.fk_id')
rightJoin('t2', 't1.id', '=', 't2.fk_id')
crossJoin('t2', 't1.id', '=', 't2.fk_id')
```