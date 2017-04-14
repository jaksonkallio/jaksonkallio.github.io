class ProjectList {
	loadProjectJson(){
		$.ajax({
			url: "../database/projects.json",
			dataType: 'json',
			async: false,
			success: function(data){
				return data;
			}
		});
	}
	constructor(container){
		var projects = this.loadProjectJson();
		$.each(projects, function(key, val){
			var project_item = $('<a href="'+val['url']+'" target="_BLANK"><div class="tag">'+val['name']+'</div></a>');
			container.append(project_item);
		});
	}
}
