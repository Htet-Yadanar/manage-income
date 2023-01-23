@extends('layouts.app')
    @section('content')
    <div class="container mt-5 pt-5">
         <!-- start new id  -->
         <div id = "new-id">
            <div class="row">
                <!-- stat draw section  -->
                <div class="col-lg-6 col-md-10 col-sm-12 align-self-center">
                    <div class="section-title">
                        <span class="title" data-aos="fade-up" data-aos-duration="600">Save Income</span>
                        <h3 class="sub-title" data-aos="fade-up" data-aos-duration="600">Don't let money run your life, let money help you run your life better.</h3>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="600">
                        {{-- <form> --}}
                            <div class="row">
                                <div class="col-5">
                                    <div class="input-group mb-3">
                                        <select class="form-control form-select mb-3" id = "month" required>
                                            <option value="" selected>Select Month</option>
                                            <option value="January" >January</option>
                                            <option value="February" >February</option>
                                            <option value="March" >March</option>
                                            <option value="April" >April</option>
                                            <option value="May" >May</option>
                                            <option value="June" >June</option>
                                            <option value="July" >July</option>
                                            <option value="August" >August</option>
                                            <option value="September" >September</option>
                                            <option value="October" >October</option>
                                            <option value="November" >November</option>
                                            <option value="December" >December</option>
                                          </select> 
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-3">
                                        <input type = "number" class = "form-control" placeholder="Monthly Income" 
                                        id = "income"/>
                                        <input type = "text" hidden class = "form-control" value = {{ auth()->user()->id }}
                                        id = "user_id"/>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <input type="button" id = "save" class="btn btn-primary btn1 px-3" value="Save"/>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                   
                </div>
                <!-- end draw section  -->
                 <!--start for image  -->
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="img-box" data-aos="fade-up" data-aos-duration="600">
                        <img src="/images/money.jpg" alt="">
                    </div>
                </div>
                <!--end for image  -->
            </div>

         </div>
         <!-- start new id   -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script> 
    $(document).ready(function() {
            var APP_URL = {!! json_encode(url('/')) !!}
            
            $(document).on('click', '#save', function(e) {
                        e.preventDefault();
                        var save_income_api = APP_URL+"/api/save-income"
                        var user_id = $('#user_id').val();
                        var income = $('#income').val();
                        var month = $('#month').val();
                        console.log(income);
                        $.ajax({
                            method: 'POST',
                            url: save_income_api,
                            data: {income:income, user_id:user_id, month:month},
                            success: function(data) {
                                console.log(data);
                                if(data.status==200){
                                    Swal.fire({
                                        icon: 'success',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        text: 'Saved!',
                                        })
                                        $('#income').val("")
                                        $('#month').val("")
                                }
                                else if(data.status==400){
                                    Swal.fire({
                                        icon: 'warning',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        text: 'Income must be greater than 0',
                                        })
                                        $('#income').val("")
                                        $('#month').val("")
                                       
                                }
                                else if(data.status==300){
                                    Swal.fire({
                                        icon: 'warning',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        text: 'Please Enter Income!',
                                        })
                                        $('#income').val("")
                                        $('#month').val("")
                                }
                                else if(data.status==301){
                                    Swal.fire({
                                        icon: 'warning',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        text: 'Please Select Month!',
                                        })
                                        $('#income').val("")
                                        $('#month').val("")
                                }
                                else if(data.status ==333){
                                    Swal.fire({
                                        text: "Already saved data for this month!Do you want to updata data?",
                                        showCancelButton: true,
                                        timerProgressBar: true,
                                        confirmButtonText: 'Yes',
                                        cancelButtonText: 'No',
                                    }).then((result) =>{
                                        if (result.isConfirmed) {
                                        var update_income_api = APP_URL+"/api/update-income"
                                        $.ajax({
                                            method: "POST",
                                            url: update_income_api,
                                            data: {
                                                data: {income:income, user_id:user_id, month:month},
                                            },
                                            success: function(data) {
                                                Swal.fire({
                                                    text: 'updated!',
                                                    timerProgressBar: true,
                                                    timer: 5000,
                                                    icon: 'success',
                                                })
                                                $('#income').val("")
                                                $('#month').val("")
                                            }
                                        })
                                    }
            })
                                }
                            }
                            })
                       
            });
    });
    </script>
    @endsection
