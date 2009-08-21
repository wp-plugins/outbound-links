<?

$options = get_option('outl');

if (isset($_POST['save']))
{
    if (!check_admin_referer()) die('No hacking please');
    $options = stripslashes_deep($_POST['options']);
    update_option('outl', $options);
}

?>

<div class="wrap">
<form method="post" action="">
<?php wp_nonce_field(); ?>
<h2>Outbound Links</h2>

<h3>Target for outbound links</h3>
<table class="form-table">
<tr valign="top">
    <th>Link opening</th>
    <td>
        <input type="checkbox" name="options[target]" value="1" <?php echo $options['target']?'checked':''; ?>/>
        <label for="options[target]">Force all outbound links to open in a new window</label>
    </td>
</tr>
</table>

<h3>Outbound links click tracking</h3>
<p><strong>You need to have Google Analytics code installed (new or old version)!</strong></p>

<table class="form-table">
<tr valign="top">
    <th>Tracking</th>
    <td>
        <input type="checkbox" name="options[track]" value="1" <?php echo $options['track']?'checked':''; ?>/>
        <label for="options[track]">Track all outbound link clicks</label>
    </td>
</tr>
<tr valign="top">
    <th>Google Analytics version</th>
    <td>
        <input type="checkbox" name="options[track_version]" value="1" <?php echo $options['track_version']?'checked':''; ?>/>
        <label for="options[track_version]">Check if you are using the old Google Analytics code (Urchin)</label>
    </td>
</tr>
<tr valign="top">
    <th>Tracking prefix</th>
    <td>
        <input type="text" name="options[track_prefix]" value="<?php echo htmlspecialchars($options['track_prefix']); ?>"/>
        <br />
        The prefix will be added to outbound link. Leave empty for "/out".<br />
        The prefix is used to search on Google Analytics the outtbound link click statistics:
        open the "content" statistics and filter the url list with "/out/".
    </td>
</tr>
<tr valign="top">
    <th>Mode</th>
    <td>
        <input type="checkbox" name="options[track_mode]" value="1" <?php echo $options['track_mode']?'checked':''; ?>/>
        <label for="options[track_mode]">Track only the outbound link domain and not the full url</label>
    </td>
</tr>
</table>

<h3>Google Analytics code</h3>
<table class="form-table">
<tr valign="top">
    <th><label for="options[footer]">Google Analytics code</label></th>
    <td>
        <textarea name="options[footer]" cols="70" wrap="off" rows="5"><?php echo htmlspecialchars($options['footer']); ?></textarea>
        <br />
        If you do not have Google analytics code already added to your blog, you can copy
        it here and it will be injected on the pages. You theme need to have the wp_footer()
        call (not all themes have it).
    </td>
</tr>
<tr valign="top">
    <th>Logged in users tracking</th>
    <td>
        <input type="checkbox" name="options[track_admin]" value="1" <?php echo $options['track_admin']?'checked':''; ?>/>
        <label for="options[track_admin]">Track the access of the logged in users</label>
        <br />
        If you use this plugin to inject Google analytics code, checking this option
        you'll enable the tracking of logged in users (like admin).
    </td>
</tr>
</table>

<p class="submit"><input type="submit" name="save" value="Save"></p>

</form>
</div>
