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
count()     // count nb rows
max('f1')   // max value of 'f1'
min('f1')
avg('f1')
sum('f1')

exists()    // determine if any records exist (equivalent to 'count > 0')
doesntExist()
```

## Selects

```php
select('f1', 'f2 as o2', ...)
select(...)->distinct()

// if the query is already built
addSelect(...)
```

## Raw expressions

```php
raw('SQL stmt')     // exec raw SQL stmt (be careful of SQL injection)
selectRaw('...')    // equivalent to addSelect(DB::raw())
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

## Where clauses

```php
where('f1', '<>', 100)
where('f1', 100)            // equivalent to 'f1 = 100'
where([                     // multi where clauses
    ['f1', 100],
    ['f2', '>', 200],
])
where()->orWhere()          // chain OR where
where(function ($query) {   // group OR condition in parentheses
    $query->where('f1', 100)
    ->where('f2', 200)
})

whereBetween('f1', [100, 200]) // whereNotBetween

whereIn('f1', [1, 2, 3]) // whereNotIn / orWhereIn / orWhereNotIn
// for huge array of integer, prefer using whereIntegerInRaw
whereIntegerInRaw() // whereIntegerNotInRaw

whereNull('f1') // whereNotNull / orWhereNull / orWhereNotNull

whereDate('created_at', '2020-01-01')
whereMonth('created_at', '8')
whereDay('created_at', '21')
whereYear('created_at', '2019')
whereTime('created_at', '=', '11:55:00')

whereColumn('f1', 'f2') // orWhereColumn : verify that 2 columns are equal
whereColumn('created_at', '>', 'updated_at')
whereColumn([
    ['f1', '>', 'f2'],
    ['f3', '=', 'f4'],
])

whereExists(function ($query) {
    $query->select(DB::raw(1))
        ->from('t2')
        ->whereRaw('t1.id = t2.t1_id');
})
```

## Ordering, Grouping, Limit & Offset

```php
orderBy('f1', 'desc')           // order by on multiple columns
    ->orderBy('f1', 'desc')

latest('f1')                    // order results by date (on 'created_at' column by default)
oldest('f1')                    // order results by date (oldest first)

inRandomOrder()                 // sort results randomly
reorder('f1')                   // remove all the existing orders (and optionally apply a new order)

groupBy('f1', 'f2')             // group by on multiple column
having('f1', '>', 100)

skip(10)                        // skip 10 results in the query
take(5)                         // get the 5 firsts results (after skipping)
offset(10)                      // equivalent to skip
limit(5)                        // equivalent to take
```
