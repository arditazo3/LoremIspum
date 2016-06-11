**BLADE**

    **FOREACH LOOP**
    
To show the index of each item at a table doing foreach with blade, can do this way

`
@foreach ($collection as $index => $element)
   {{$index}} - {{$element['name']}}
@endforeach
`