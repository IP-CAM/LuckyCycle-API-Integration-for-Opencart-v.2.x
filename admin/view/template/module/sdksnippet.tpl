<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
            <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
        <h1><?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="container-fluid">
<?php if ($error_warning) { ?>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
<div class="panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
</div>
<div class="panel-body">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
    <div class="form-group required">
        <label class="col-sm-2 control-label" for="sdksnippet_text_field"><?php echo $api_id; ?></label>
        <div class="col-sm-10">
            <input type="text" name="sdksnippet_text_field" id="sdksnippet_text_field" value="<?php echo $sdksnippet_text_field; ?>" placeholder="<?php echo $api_id; ?>" class="form-control" />
            <?php if ($error_api_id) { ?>
            <div class="text-danger"><?php echo $error_api_id; ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group required">
        <label class="col-sm-2 control-label" for="sdksnippet_operation_id"><?php echo $operation_id; ?></label>
        <div class="col-sm-10">
            <input type="text" name="sdksnippet_operation_id" id="sdksnippet_operation_id" value="<?php echo $sdksnippet_operation_id; ?>" placeholder="<?php echo $operation_id; ?>" class="form-control" />
            <?php if ($error_operation_id) { ?>
            <div class="text-danger"><?php echo $error_operation_id; ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdksnippet_use_mode"><?php echo $use_mode; ?></label>
        <div class="col-sm-10">
            <select name="sdksnippet_use_mode">
                <?php foreach ($use_mode_datas as $use_mode_data) { ?>
                <?php if ($use_mode_data['alias'] == $sdksnippet_use_mode) { ?>
                <option value="<?php echo $use_mode_data['alias']; ?>" selected="selected"><?php echo $use_mode_data['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $use_mode_data['alias']; ?>"><?php echo $use_mode_data['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdksnippet_iframe_width"><?php echo $iframe_width; ?></label>
        <div class="col-sm-10">
            <input type="text" name="sdksnippet_iframe_width" id="sdksnippet_iframe_width" value="<?php echo $sdksnippet_iframe_width; ?>" placeholder="<?php echo $iframe_width; ?>" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdksnippet_iframe_height"><?php echo $iframe_height; ?></label>
        <div class="col-sm-10">
            <input type="text" name="sdksnippet_iframe_height" id="sdksnippet_iframe_height" value="<?php echo $sdksnippet_iframe_height; ?>" placeholder="<?php echo $iframe_height; ?>" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-banner"><?php echo $upload_banner; ?></label>
        <div class="col-sm-10">
            <a href="" id="thumb-banner" data-toggle="image" class="img-thumbnail"><img src="<?php echo $banner; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
            <input type="hidden" name="sdksnippet_luckycycle_banner" value="<?php echo $sdksnippet_luckycycle_banner; ?>" id="input-banner" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdksnippet_other_information"><?php echo $other_information_label; ?></label>
        <div class="col-sm-10"><textarea name="sdksnippet_other_information" cols="40" rows="5"><?php echo $sdksnippet_other_information; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdksnippet_after_information"><?php echo $after_information_label; ?></label>
        <div class="col-sm-10"><textarea name="sdksnippet_after_information" cols="40" rows="5"><?php echo $sdksnippet_after_information; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sdkextension-select"><?php echo $entry_payment_method; ?></label>
        <div class="col-sm-10">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($extensions as $extension) { ?>
                <div class="checkbox">
                    <label>
                        <?php if (is_array($sdksnippet_sdkextension) && in_array($extension['alias'], $sdksnippet_sdkextension)) { ?>
                        <input type="checkbox" name="sdksnippet_sdkextension[]" value="<?php echo $extension['alias']; ?>" checked="checked" />
                        <?php echo $extension['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="sdksnippet_sdkextension[]" value="<?php echo $extension['alias']; ?>" />
                        <?php echo $extension['name']; ?>
                        <?php } ?>
                    </label>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</form>
</div>
</div>
</div></div>

<?php echo $footer; ?>