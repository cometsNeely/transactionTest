<h1>Your balance: <?php echo Session::get('balance');?></h1> 

<?php use App\Http\Controllers\AuthController;
    use App\Http\Controllers\TransactionController;
?>

<form action="{{route('buy')}}" method="post">
@csrf
<input type="text" id="buy" name="buy">
<button type="submit" name="ok">Buy</button>
</form>
<form action="{{route('sale')}}" method="post">
@csrf
<input type="text" id="buy" name="buy">
<button type="submit" name="ok2">Sale</button>
</form>

<button class="btn"><a href="{{ route('logout') }}">Exit</a></button>