/**
 * 选择头像
 */
function sface() {
	var fm = document.register;
	var index = fm.face.selectedIndex;
	fm.faceimg.src='./image/'+fm.face.options[index].value;
}
function rface() {
	var fm = document.register;
	var index = fm.face.selectedIndex;
	fm.faceimg.src='../image/'+fm.face.options[index].value;
}