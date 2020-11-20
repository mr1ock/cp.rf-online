
<style type="text/css">
.lierr { 
     font-size: 16px; 
     font-family:"Segoe UI",'Roboto',"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"; 
     color: #DC3545;
     margin: 5px;
     font-weight: bold
     
    }

   </style>

@if (count($errors))

    <div class="form-group">


            <ul>
                @foreach ($errors->all() as $error)
                     <li class="lierr">{{ $error }}</li>    
                @endforeach
            </ul>

    </div>
@endif