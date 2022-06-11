<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    <table>
        <thead>
              <tr>                
                <th>Document Id</th>
                <th>Name</th>
                <th>Added on</th>
              </tr>
            </thead>
            <tbody>
                @foreach($duplicates as $dup)
                <tr>
                    <td>{{$dup['id']}}</td>
                    <td>{{$dup['doc_name']}}</td>
                    <td>{{$dup['created_at']}}</td>
                </tr>
                @endforeach
            </tbody> 
    
    </table>

    </body>
</html>
