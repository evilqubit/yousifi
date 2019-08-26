<tr id='<?php echo $doc['Media']['id']; ?>' >
	<th  class='handle' ><img width="25px" height="25px" src="<?php echo $this->Doc->get_icon($doc); ?>"/></th>
	<th class='handle'><?php echo $doc['Media']['docName']; ?></th>
	<th  class='handle'><?php echo  $doc['Media']['created']; ?></th>
	<th class='handle'><?php echo  $doc['Media']['filesize']; ?></th>
	<th><a  target='_blank' href='<?php echo  $doc['Media']['docUrl']; ?>'>Download</a> | <a class='delete-doc' doc-id='<?php echo $doc['Media']['id']; ?>' href='#'>Delete</a></th>
</tr>
