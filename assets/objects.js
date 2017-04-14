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
			console.log(projects);
			for(var i = 0; i < projects.length; i++){
				var project_item = $('<a href="'+projects[i]['url']+'" target="_BLANK"><div class="tag">'+projects[i]['name']+'</div></a>');
				container.append(project_item);
			}
		});
	}
}
