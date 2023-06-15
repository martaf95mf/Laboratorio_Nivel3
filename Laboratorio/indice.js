function toggle (){

    var items = document.getElementsByClassName('item');
	for (var i=1; i<items.length; i++) {
        if (items[i].style.display == ''){
            items[i].style.display = 'block';
        } else {
            items[i].style.display = '';
        }
        }
}