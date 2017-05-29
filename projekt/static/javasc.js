  $(function() {
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
} );

function reg(){
	location.href ="http://enos.itcollege.ee/~ksaluvee/projekt/kontroller.php?mode=register";
} ;


function quotes()  {
	var sentences= ["Beware of little expenses; a small leak will sink a great ship. --B. Franklin", "You must gain control over your money or the lack of it will forever control you. --D. Ramsey", "The habit of saving is itself an education; it fosters every virtue, teaches self-denial, cultivates the sense of order, trains to forethought, and so broadens the mind. --T.T. Munger"];
    setInterval(function(){ 
 	var nr = Math.round(Math.random() * (sentences.length-1));
 	document.getElementById('changing').innerHTML = sentences[nr];
 	$('#changing').html(sentences[nr]); }, 5000);
};