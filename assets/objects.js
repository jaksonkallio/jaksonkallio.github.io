class ProjectList {
	loadProjectJson(callback){
		$.ajax({
			url: "../database/projects.json",
			dataType: 'json',
			success: function(data){
				callback(data);
			}
		});
	}
	constructor(container){
		this.loadProjectJson(function(projects){
			$.each(projects, function(key, val){
				var project_item = $('<a href="'+val['url']+'" target="_BLANK"><div class="tag">'+val['name']+'</div></a>');
				container.append(project_item);
			});
		});
	}
}
