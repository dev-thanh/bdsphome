<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
    <td class="index">{{ $index }}</td>
	<td>
		<input type="text" class="form-control" name="color_content[{{ $id }}][title]" value="{{ @$value->title }}">
	</td>
	<td>
		<input type="text" class="form-control" id="color_content_{{ $id }}" name="color_content[{{ $id }}][value]" value="{{ @$value->value }}">
	</td>
    <td>
		<input type="color" class="form-control" id="color-{{ $id }}" value="{{ @$value->value }}" value="#000">
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
    let colorInput = document.getElementById('color-{{ $id }}');
    colorInput.addEventListener('input', () =>{
        let colorValue = colorInput.value;
        document.getElementById('color_content_{{ $id }}').value = colorValue;
    });
</script>