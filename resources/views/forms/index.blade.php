<!-- index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     <div class="row">
     <div class="col-lg-8">
     <h1>Coin List</h1>
     </div>
     <div class="col-lg-4">
     <a href="{{action('FormController@create')}}" class="btn btn-primary">Add New Coin</a>
     </div>
     </div>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>CoinName</th>
        <th>CoinPrice</th>
        <th>CoinImage</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($forms as $form)
      <tr>
        <td>{{$form['id']}}</td>
        <td>{{$form['coinname']}}</td>
        <td>{{$form['coinprice']}}</td>
        @if($form['coinimage'] != '')
        <td><img style="width:50px;" src="{{asset('images/'.$form['coinimage'])}}" alt="coinimages"/></td>
        @else
        <td><img style="width:50px;" src="{{asset('images/images.png')}}" alt="coinimages"/></td>
        @endif
        <td><a href="{{action('FormController@edit', $form['id'])}}" class="btn btn-warning">Edit</a></td>
        <td>
          <form action="{{action('FormController@destroy', $form['id'])}}" method="post" onsubmit="return confirm('Do you really want to Delete?');">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <input name="coinimage" type="hidden" value="{{$form['coinimage']}}">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>

