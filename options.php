<?
function outl_field_text($name, $label='', $tips='', $attrs='')
{
  global $options;
  if (strpos($attrs, 'size') === false) $attrs .= 'size="30"';
  echo '<tr><td class="label">';
  echo '<label for="options[' . $name . ']">' . $label . '</label></td>';
  echo '<td><input type="text" ' . $attrs . ' name="options[' . $name . ']" value="' . 
    htmlspecialchars($options[$name]) . '"/>';
  echo ' ' . $tips;
  echo '</td></tr>';
}

function outl_field_checkbox($name, $label='', $tips='', $attrs='')
{
  global $options;
  echo '<tr><td class="label">';
  echo '<label for="options[' . $name . ']">' . $label . '</label></td>';
  echo '<td><input type="checkbox" ' . $attrs . ' name="options[' . $name . ']" value="1" ' . 
    ($options[$name]!= null?'checked':'') . '/>';
  echo ' ' . $tips;
  echo '</td></tr>';
}

if (isset($_POST['save']))
{
    $options = $_REQUEST['options'];
    update_option('outl', $options);
}
else 
{
    $options = get_option('outl');
}
?>
<div class="wrap">
<form method="post">

<h2>Outbound Links</h2>

<p>This plugin uses the Google Analytics service to track all the outbound links
the visitors click on the blog. It can add a "target blank" to those links
forcing the opening in a new window.
</p>

<h3>Configuration</h3>
<table>
<? outl_field_checkbox('track', 'Track the outbound clicks'); ?>
<? outl_field_checkbox('target', 'Open outbound link in a new window'); ?>
</table>

<p><input type="submit" name="save" value="Save">
</form>
</div>
