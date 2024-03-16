var str = document.getElementById('game-rating').textContent;
str = str.replace(/(\d+)/g,function(a){return Array(+a+1).join('★')});
document.getElementById('game-rating').innerHTML = str;