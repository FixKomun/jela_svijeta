<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,700;1,400;1,700&display=swap');
        </style>
        <title>Jela svijeta</title>
        @vite('resources/js/app.js')
    </head>
    <body>
        <div>
            <h1 class="main-title">Jela Svijeta</h1>
        </div>
      
        <div class="meal-container">
        @foreach ($meals as $meal)   
     
            <div class="meal-card">
                <h1 class="meal-id">Meal #{{ $meal->id}}</h1>    
                <div class="meal-info">    
                  
                    <h2 class="title"><span>Title: </span>{{ $meal->title}}</h2>
                    <h2 class="desc"><span>Description:</span> {{ $meal->description}}</h2>
                    <h2 class="title"><span>Status: </span>"{{ ucwords($meal->status)}}"</h2>
                    @isset($withArray)
                        @foreach ($withArray as $withItem)
                        @if ($withItem=="ingredients")
                            @foreach ($meal->ingredients as $ingredient)
                            <h2 class="desc"><span>Ingredient {{ $ingredient->id }} </span>{{ $ingredient->title}}</h2>                           
                            @endforeach
                        @endif
                        @if($withItem=="tags")
                             @foreach ($meal->tags as $tag)
                             <h2 class="desc"><span>Tag {{ $tag->id }} </span>{{ $tag->title}}</h2>
                            @endforeach   
                        @endif
                        @if($withItem=="category")
                           @if($meal->category===null)
                           <h2 class="desc-null"><span>Category:</span> No Category</h2>
                           @else
                           <h2 class="desc"><span>Category: </span>{{ $meal->category->title}}</h2>
                           @endif
                        @endif
                        @endforeach                                       
                    @endisset
                             
                
                                      
                </div> 
            </div>
       
        @endforeach
    
        </div>
         <!--PAGE NUMBER REQUEST --BOOTSTRAP PAGINATIOR-->
         @if(request('per_page'))
         {{ $meals->links() }}
         @endif
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
 
</html>
