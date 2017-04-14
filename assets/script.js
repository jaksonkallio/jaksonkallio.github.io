class ProjectList {
	constructor(container){
		
	}
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
}
