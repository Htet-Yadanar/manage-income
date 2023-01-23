@extends('layouts.app')
@section('content')
<div class="container mt-5 pt-5">

    <div class="modal fade" id ="editModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Wish list item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <input type="text" class="form-control" required placeholder="Enter Item Name" id = "edit_item_name">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" required placeholder="Enter Item Price" id = "edit_item_price">
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 offset-9 ">
                        <input type="submit" class="btn btn-primary btn1 px-3" value="Update" id = "update" data-aos="fade-down" data-aos-duration="600">
                    </div>
                </div>
            </div> 
    
          </div>
        </div>
    </div>

    <!-- row start  -->
    <div class="row d-flex justify-content-center ">
        <div class="col-8">
            <div class="section-title">
                            <span class="title" data-aos="fade-up" data-aos-duration="600">
                                Wish List
                            </span>
                            <h3 class="sub-title" data-aos="fade-up" data-aos-duration="600">
                                If you buy things you do not need, soon you will have to sell things you need.
                            </h3>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center ">
        <div class="col-6">
                
                <form action=""  enctype="multipart/form-data">
                    <div class="row" >
                        <div class="col-4">
                            <input type="text" class="form-control" id="item-name" data-aos="fade-down" data-aos-duration="600" placeholder="Enter Item Name">
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" id="item-price" data-aos="fade-down" data-aos-duration="600" placeholder="Enter Item Price">
                            <input type="text" hidden class="form-control" required placeholder="Enter Item Price"
                             id = "user_id" value = {{ auth()->user()->id }}>
                        </div>
                        <div class="col-3 justify-content-end">
                            <input type="submit" class="btn btn-primary btn1 px-3" value="Add" id = "save" data-aos="fade-down" data-aos-duration="600">
                        </div>
                    </div>
        </div>
    </div>
      
   

    <!-- row start  -->
    <div class="row my-5 d-flex justify-content-center ">
        <div class="col-8">
            <div class="section-title">
                            <span class="title" data-aos="fade-up" data-aos-duration="600">
                                Wish List
                            </span>
                            <h3 class="sub-title" data-aos="fade-up" data-aos-duration="600">Things that I want</h3>
            </div>
        </div>
        <div class="col-6">
                <table class="table table-striped table-hover table-responsive" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <thead class="table-custom">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody class="table-custom">
                    @php $i = 1 @endphp
                     @foreach ($data as $value)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->price}}</td>
                            <td>
                               <a href="#" data-id = {{ $value->id }} id = "edit"><i class="fa-regular fa-pen-to-square fa-lg" ></i></a>
                               <a href="#" data-id = {{ $value->id }} id = "delete"><i class="fa-solid fa-trash-can fa-lg"></i></a>
                            </td>
                        </tr> 
                     @endforeach 
                    <tr>
                        <td colspan="4">
                        <div class="d-flex justify-content-center pagination">
                            <!-- a Tag for previous page -->
                            <a href="{{$data->previousPageUrl()}}" class="num"> 
                            <!-- You can insert logo or text here --> Prev
                            </a>
                            <!-- @for($i=1;$i<=$data->lastPage();$i++) -->
                            <!-- a Tag for another page -->
                             <a href="{{$data->url($i)}}" class="num">{{$i}}</a>
                            @endfor
                            <!-- a Tag for next page -->
                             <a href="{{$data->nextPageUrl()}}" class="num"> 
                            <!-- You can insert logo or text here -->Next
                            </a>
                        </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
        </div>
    </div> 
    <!-- row end -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script> 
$(document).ready(function() {
        var APP_URL = {!! json_encode(url('/')) !!}
        $(document).on('click', '#save', function(e) {
                    e.preventDefault();
                    var save_wish_list_api = APP_URL+"/api/save-wish-list"
                    var name = $('#item-name').val();
                    var price = $('#item-price').val();
                    var user_id = $('#user_id').val();
                    $.ajax({
                        method: 'POST',
                        url: save_wish_list_api,
                        data: {name:name , price:price , user_id:user_id},
                        success: function(data) {
                            if(data.status==200){
                                Swal.fire({
                                    icon: 'success',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    text: 'Saved!',
                                    }).then((result) => {
                                        window.location.reload();
                                    }) 
                                    $('#item-name').val("")
                                    $('#item-price').val("")
                            }
                            else{
                                Swal.fire({
                                    icon: 'warning',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    text: data.message,
                                    })
                                    $('#item-name').val("")
                                    $('#item-price').val("")
                            }
                        }
                        })
                   
        });

        $(document).on('click', '#edit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#editModal').modal('show');
            var url = APP_URL+"/api/edit-wish-list"
                $.ajax({
                    type: "post",
                    url: url,
                    data : {id:id},
                    datatype: "json",
                    success: function(data) {
                        $('#edit_item_name').val(data.data.name);
                        $('#edit_item_price').val(data.data.price);
                        $('#update').data('id',id);
                    }
                })
        });

        $(document).on('click', '#update', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#editModal').modal('show');
            var name  = $('#edit_item_name').val();
            var price = $('#edit_item_price').val();
            var url = APP_URL+"/api/update-wish-list"
                $.ajax({
                    type: "post",
                    url: url,
                    data : {id:id,name:name,price:price},
                    datatype: "json",
                    success: function(data) {
                        Swal.fire({
                            text: "Updated!",
                        }).then((result) => {
                            window.location.reload();
                        }) 
                    }
                })
        });


        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            Swal.fire({
                        text: "Are you sure?",
                        showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                        showCancelButton: true,
                        timerProgressBar: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).data('id');
                            var url = APP_URL+"/api/delete-wish-list"
                                $.ajax({
                                    type: "post",
                                    url: url,
                                    data : {id:id},
                                    datatype: "json",
                                    success: function(data) {
                                        Swal.fire({
                                             text: "Deleted!",
                                        }).then((result) => {
                                            window.location.reload();
                                        }) 
                                    }
                                })
                        }
                        })
        });

});
</script>

@endsection