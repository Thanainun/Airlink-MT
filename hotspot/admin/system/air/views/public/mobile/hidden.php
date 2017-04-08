<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

print form_hidden('button','Login').
	  form_hidden('challenge',$challenge).
	  form_hidden('uamip',$uamip).
	  form_hidden('uamport',$uamport).
	  form_hidden('userurl',$userurl);

print form_hidden('',$_GET);
	