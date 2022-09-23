<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .delete {
            background: rgb(247, 15, 1, 0.7);
        }

        .container {
            max-width: 1024px;
        }
    </style>
    <title>{{ config('app.name') }}</title>
</head>

<body>
    @include('includes.header')
    <main class="flex-grow-1 py-3">
        @yield('content')
    </main>
    @include('includes.footer')


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        $(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
        }
    });
    let test = $(".data-test").DataTable({
        serverSide:true,
        proccesing:true,
        ajax:"{{route('students')}}",
        columns: [
            {data: "DT_RowIndex", name:"DT_RowIndex"},
            {data: "first", name:"first"},
            {data: "last", name:"last"},
            {data: "country", name:"country"},
            {data: "action", name:"action"},     
        ]
    })
    $('#createStudent').click(function(){
        $('#id').val('');
        $('#studentForm').trigger("reset");
        $('#modalHeading').html("Добавить студента")
        $("#ajaxModal").modal('show');
    });
    $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Cохранить');
        $.ajax({
            headers:{
            'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')
            },
            data:$("#studentForm").serialize(),
            url: "{{route('students.store')}}",
            type:"POST",
            dataType:"json",
            success:function(data){
                $('#studentForm').trigger("reset");
                $("#ajaxModal").modal('hide');
                test.draw();
            },
            error:function(data){
                console.log("Ошибка:",data);
                $("#saveBtn").html("Сохранить");
            }

            });
        });
        
        
        $('body').on('click', '.deleteStudent', function(){
            let student_id = $(this).data("id");
            confirm("Вы уверены что хотите удалить запись?");
            $.ajax({
                type:"GET",
                url:"students"+'/'+student_id,
                success:function(data){
                    test.draw();
                },
                error:function(data){
                console.log("Ошибка:",data);
                console.log("Ошибка:",id);
            }
            });
        });

        $('body').on('click', '.editStudent',  function(){
            let student_id = $(this).data('id');
            $.get("students/"+student_id+"/edit", function(data){
                $("#modalHeading").html("Изменить студента");
                $('#ajaxModal').modal('show');
                $("#id").val(data.id);
                $("#first").val(data.first);
                $("#last").val(data.last);
                $("#country").val(data.country);
            });
            
         });

  });

    </script>

</body>

</html>