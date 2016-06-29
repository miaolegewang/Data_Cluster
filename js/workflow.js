function disable(){
	var k = document.getElementsByClassName('man');
	var len = k.length;
	for(var i = 0; i < len; i++){
		k[i].disabled = true;
	}
}

function enable() {
	var k = document.getElementsByClassName('man');
	var len = k.length;
	for(var i = 0; i < len; i++){
		k[i].disabled = false;
	}
}

function check(id) {
	var whether = document.getElementsByName('ifman');
	if(whether[0].checked == true){
		var l = document.getElementsByName('l');
		if(l[0].checked == false && l[1].checked == false){
			l[0].focus();
			return false;
		}
		var ng = document.getElementsByName('ng');
		if(ng[0].checked == false && ng[1].checked == false){
			l[0].focus();
			return false;
		}
		var na = document.getElementsByName('na');
		if(na[0].checked == false && na[1].checked == false){
			na[0].focus();
			return false;
		}
		var cg = document.getElementsByName('cg');
		if(cg[0].checked == false && cg[1].checked == false){
			cg[0].focus();
			return false;
		}
		var ca = document.getElementsByName('ca');
		if(ca[0].checked == false && ca[1].checked == false){
			ca[0].focus();
			return false;
		}
	}
	var g = document.getElementsByName('g');
	var judge = false;
	for(var i = 0; i < g.length; i++)
		if(g[i].checked == true)
			judge = true;
	if(judge == false){
		g[0].focus();
		return false;
	}
	var e = document.getElementsByName('e');
	judge = false;
	for(var i = 0; i < e.length; i++)
		if(e[i].checked == true)
			judge = true;
	if(judge == false){
		e[0].focus();
		return false;
	}
	var m = document.getElementsByName('m');
	judge = false;
	for(var i = 0; i < m.length; i++)
		if(m[i].checked == true)
			judge = true;
	if(judge == false){
		m[0].focus();
		return false;
	}
	return true;
}

function method(value){
	var b = document.getElementById('cluster_setup');
	b.cluster.value = value;
}

function form_submit(id){
	document.getElementById(id).submit();
}


