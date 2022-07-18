var val = document.FileList.hiddenInfo.value;
alert("val is " + val); // this prints null which is as expected
if (val != null) {
    alert("value is " + val.length); // this returns 4
} else {
    alert("value* is null");
}