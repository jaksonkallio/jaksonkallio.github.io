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
			container.html('');
			for(var i = 0; i < projects.length; i++){
				if(projects[i]['display']){
					var project_item = '<a class="item" href="'+projects[i]['url']+'" target="_BLANK"><div class="title">'+projects[i]['name']+'</div></a>';
					container.append(project_item);
				}
			}
		});
	}
}
