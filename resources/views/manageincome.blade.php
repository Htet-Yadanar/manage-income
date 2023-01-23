@extends('layouts.app')
@section('content')
<div class="container mt-5 pt-2">
    <div class="row my-5 d-flex justify-content-center ">
        <div class="col-8">
            <div class="section-title">
                            <span class="title" data-aos="fade-up" data-aos-duration="600">
                                Item List
                            </span>
                            <h3 class="sub-title" data-aos="fade-up" data-aos-duration="600">Things you can buy.</h3>
            </div>
        </div>
        <div class="col-6">
                <table class="table table-striped table-hover table-responsive" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <thead class="table-custom">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Month</th>
                    <th scope="col">Item Name</th>
                    </tr>
                </thead>
                
                <tbody class="itemlist">
                    
                     {{-- @foreach ($data as $value) --}}
                      
                         <tr class="">
                            {{-- <th>{{$i++}}</th>
                            <td>{{$value->month}}</td>
                            <td> 
                                @foreach ($value->itemname as $item)
                                <p>{{ $item->name }} ,</p> 
                                @endforeach
                            </td> --}}
                        </tr>  
                     {{-- @endforeach  --}}
                </tbody>

                </table>
        </div>
    </div> 
    <!-- row end -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script> 
$(document).ready(function() {
    var data = @json($data);
        console.log(data)
        let htmlView = '';
        
        for(let i = 0; i < data.length; i++){
            var tempArr = []
            for(let j = 0;j < data[i].itemname.length; j++){
                var tempStr = `${data[i].itemname[j].name}`
                var sum = data[i].itemname[j].price
                for(let k = j+1; k < data[i].itemname.length;k++){
                    
                    sum += data[i].itemname[k]?.price
                    if(j === k){
                        continue
                    }
                    console.log(sum,sum <= data[i].total_extra_money)
                    if(sum <= data[i].total_extra_money){
                        tempStr += ` and ${data[i].itemname[k]?.name}`
                        tempArr.push(tempStr)
                    }else if(sum > data[i].total_extra_money){
                        sum = data[i].itemname[j].price
                        continue
                    }
                }
            }

            console.log(tempArr)
            var finalArr = new Set(tempArr)
            for(let u = 0; u < tempArr.length;u++){
                for(let p = 0;p < tempArr.length;p++){
                    if(u === p){
                        continue
                    }

                    console.log(tempArr[u].includes(tempArr[p]))
                    

                    if(tempArr[u].includes(tempArr[p])){
                        finalArr.delete(tempArr[p])
                       
                    }

                }
            }
            finalArr = Array.from(finalArr)
            
            var finalString = ``

            for(let q = 0; q < finalArr.length;q++){
                if(q !== finalArr.length-1){
                    finalString += `${finalArr[q]} OR `
                }else{
                    finalString += `${finalArr[q]}`
                }
            }
            htmlView = `
                            <tr>
                            <td>${i+1}</td>
                            <td>`+data[i].month+`</td>
                            <td>${
                              finalString
                            }</td>
                            </tr>
            `
           
            $('.itemlist').append(htmlView);
            
        }
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