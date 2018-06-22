<?php
/**
 *
 */
class TemplateEngine {
 function get_content($file, $data, $stuff) {
	   $template = file_get_contents($file);
	   foreach($data as $key => $value) {
	     $template = str_replace('{{'.$key.'}}', $value, $template);
	   }

		 $template = str_replace('{{#each Stuff}}', '<?php for($i =0; $i < sizeof($stuff); $i++) { ?>', $template);
		 $template = str_replace("{{Thing}}", '<?php echo $stuff[$i]["Thing"] ?>', $template);
		 $template = str_replace("{{Desc}}", '<?php echo $stuff[$i]["Desc"] ?>', $template);
		 $template = str_replace("{{#unless @last}}", '<?php if($i != sizeof($stuff)-1){ ?>', $template);
		 $template = str_replace("{{else}}", '<?php }else{ ?>', $template);
		 $template = str_replace("{{/unless}}", '<?php  }?>', $template);
		 $template = str_replace('{{/each}}', '<?php } ', $template);

		 $template = eval('?>' . $template);
	   return $template;
	}
}


$file = 'extra.tmpl';
$data = array('Name'  => "Shyamala");
$stuff = array(
	array(
		"Thing" => "roses",
		"Desc"  => "red"
	),
	array(
		"Thing" => "violets",
		"Desc"  => "blue"
	),
	array(
		"Thing" => "you",
		"Desc"  => "able to solve this"
	),
	array(
		"Thing" => "we",
		"Desc"  => "interested in you"
	)
);
$template_engine = new TemplateEngine();
echo $template_engine->get_content($file, $data, $stuff);



?>
