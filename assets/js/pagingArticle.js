function Pager(tableName, itemsPerPage, name, numberIndex) {
  this.tableName = tableName;
  this.itemsPerPage = itemsPerPage;
  this.currentPage = 1;
  this.pages = 0;
  this.inited = false;
  this.name = name

  this.showRecords = function(from, to) {
    var rows = document.getElementById(tableName).children;
        // i starts from 1 to skip table header row
        for (var i = 0; i < rows.length; i++) {

          if (i < from || i > to)
            $(rows[i]).slideUp()
          else
            $(rows[i]).slideDown()
        }
      }

      this.showPage = function(pageNumber) {
       if (! this.inited) {
        alert("Error 1 !");
        return;
      }
      var oldPageAnchor = document.getElementById(`pg${this.name}${this.currentPage}`);
      oldPageAnchor.className = 'pg-normal pointer';

      this.currentPage = pageNumber;
      var newPageAnchor = document.getElementById(`pg${this.name}${this.currentPage}`);
      newPageAnchor.className = 'pg-selected active pointer';

      var from = (pageNumber - 1) * itemsPerPage + 1;
      var to = from + itemsPerPage - 1;
      this.showRecords(from, to);
    }

    this.prev = function() {
      if (this.currentPage > 1)
        this.showPage(this.currentPage - 1);
    }

    this.next = function() {
      if (this.currentPage < this.pages)
        this.showPage(this.currentPage + 1);
    }

    this.init = function() {
      var rows = document.getElementById(tableName).children;
      var records = (rows.length - 1);
      this.pages = Math.ceil(records / itemsPerPage);
      this.inited = true;
    }

    this.showPageNav = function(pagerName, positionId) {
    	if (! this.inited) {
    		alert("Error 2 !");
    		return;
    	}
    	var element = document.getElementById(positionId);

      var pagerHtml = `<li onclick="${pagerName}.prev()" class="pg-normal pointer">
          <a><i class="fa fa-arrow-left black-text"></i></a>
        </li>`;

      for (var page = 1; page <= this.pages; page++){
        pagerHtml += `<li id="pg${name}${page}"
            onclick="${pagerName}.showPage(${page});" class="pointer" style="display:none">
            <a>${page}</a>
          </li>`;
      }

      pagerHtml += `<li onclick="${pagerName}.next()" class="pg-normal pointer">
          <a><i class="fa fa-arrow-right black-text"></i></a>
        </li>`;

      element.innerHTML = pagerHtml;
   }
 }
