<div class="alert alert-{{ (isset($alert_type)) ? $alert_type : 'info' }} alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{ $msg }}
</div>