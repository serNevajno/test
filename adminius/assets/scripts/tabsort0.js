-function(){
	
	var hc = function (s, c) {return ~(" " + s + " ").indexOf(" " + c + " ")},
	 ac = function (e, c) {var s = e.className; if (!hc(s, c)) e.className += " " + c};
	
	prepTabs = function (e, t){
		var el, th, ts = (t) ? [t] : document.getElementsByTagName("table");
		for (var e in ts) {
			el = ts[e]
			if (!hc(el.className, "sortable")) continue
			if (!el.tHead) {
				th = document.createElement("thead")
				th.appendChild(el.rows[0])
				el.appendChild(th)
			}
			th = el.tHead
			ac(th, "c_0_c")
			th.title = "Сортировать"
			th.onclick = clicktab
			el.sorted = NaN
			//reset
			el.tb = el.tBodies[0]
			el.tb_res = el.tb.cloneNode(true) 
			el.th_res = th.cloneNode(true) 
			el.a_color = 0 
		}
	}
	
	var clicktab = function (e) {
		e = e || window.event
		var obj = e.target || e.srcElement;
		while (!obj.tagName.match(/^(th|td)$/i)) obj = obj.parentNode
		var i = obj.cellIndex, t = obj.parentNode, cn = obj.className, verse = /d\_\d+\_d/.test(cn);
		while (!t.tagName.match(/^table$/i)) t = t.parentNode
		var j = 0, rows = t.tb.rows, l = rows.length, c, v, vi;
		
		if (e.ctrlKey) { /* reset */
			t.replaceChild(t.tb_res, t.tb); 
			t.replaceChild(t.th_res, t.tHead); 
			prepTabs(null, t); 
			return;
		}
		 
		if (i !== t.sorted) {
			if (t.a_color < 9) t.a_color++ 
			else t.a_color = 1
			t.sarr = []
			for (j; j < l; j++) {
				c = rows[j].cells[i]
				vi = c.getAttribute('val_calc');
				if (!vi) {
					v = (c) ? (c.innerHTML.replace(/\<[^<>]+?\>/g, '')) : ''
					vi = Math.round(100 * parseFloat(v)).toString()
					if (isFinite(vi)) while (vi.length < 10) vi = '0' + vi
					else vi = v
					c.setAttribute('val_calc', vi)
				}
				t.sarr[j] = [vi + (j/1000000000).toFixed(10), rows[j]]
				//c.innerHTML = t.sarr[j][0]
			}
		}
		t.sarr = (verse) ? t.sarr.reverse() : t.sarr.sort()
		t.sorted = i
		
		var dir = (verse) ? "u" : "d", new_cls = dir + "_" + t.a_color + "_" + dir,
		 a_re = /[cdu]\_\d+\_[cdu]/;
		if (a_re.test(cn)) obj.className = cn.replace(a_re, new_cls)
		else obj.className = new_cls
		for (j = 0; j < l; j++) t.tb.appendChild(t.sarr[j][1])
		obj.title = "Отсортировано по " + ((verse) ? "убыванию" : "возрастанию")
	}
	window.onload = prepTabs
}()

