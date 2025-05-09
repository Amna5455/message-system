<?php
$count = 0;
if(Auth::check()){
    $count = Auth::user()->newThreadsCount();
}
?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif
