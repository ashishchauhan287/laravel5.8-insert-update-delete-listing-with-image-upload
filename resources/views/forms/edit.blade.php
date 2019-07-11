<!-- edit.blade.php -->
@php
    $values = explode(",", $form->checkbox);
@endphp

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel 5 CRUD Tutorial With Example From Scratch </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div><br />
      @endif
      <div class="row">
     <div class="col-lg-8">
     <h2>Edit Coin</h2>
     </div>
     <div class="col-lg-4">
     <a href="{{action('FormController@index')}}" class="btn btn-primary">View Coin List</a>
     </div>
     </div>
      <form method="post" action="{{action('FormController@update', $id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">CoinName:</label>
            <input type="text" class="form-control" name="coinname" value="{{$form->coinname}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="price">CoinPrice:</label>
              <input type="text" class="form-control" name="coinprice" value="{{$form->coinprice}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-left:38px">

                 <lable>Keep</lable>
                   <input type="radio" name="radio" value="keep"  @if($form->radio == 'keep') checked @endif>
                 <lable>Port</lable>
                     <input type="radio" name="radio" value="port"  @if($form->radio == 'port') checked @endif>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-left:38px">
                <lable>Level</lable>
                <select name="dropdown">
                  <option value="beginner"  @if($form->dropdown=="beginner") selected @endif>Beginner</option>
                  <option value="intermediate"  @if($form->dropdown=="intermediate") selected @endif>Intermediate</option>
                  <option value="advance" @if($form->dropdown=="advance") selected @endif>Advance</option>  
                </select>
            </div>
        </div>
         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-left:38px">

               <lable>Exchanges :</lable>
               <div class="checkbox">
                  <label><input type="checkbox" value="coindesk" name="option[]" @if(in_array("coindesk", $values)) checked @endif>Coindesk</label>
               </div>
                <div class="checkbox">
                   <label><input type="checkbox" value="coinbase" name="option[]"  @if(in_array("coinbase", $values)) checked @endif>CoinBase</label>
              </div>
               <div class="checkbox">
                  <label><input type="checkbox" value="zebpay" name="option[]" @if(in_array("zebpay", $values)) checked @endif>Zebpay</label>
               </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-left:38px">

               <lable>Coin Image :</lable>
               <input type="file" name="coinimage" id="coinimage" >
               <input type="hidden" name="oldimage" id="oldimage" value="{{$form->coinimage}}">
               @if($form->coinimage=="")
               <img style="width:50px;padding-left:10px;" src="{{asset('images/images.png')}}" alt="coinimages"/>
                @else
                <img style="width:50px;padding-left:10px;" src="{{asset('images/'.$form->coinimage)}}" alt="coinimages"/>
                @endif
            </div>
         </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>