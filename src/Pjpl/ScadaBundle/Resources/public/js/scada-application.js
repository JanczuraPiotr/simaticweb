'use strict';

scada.Application = function(){
	var def = this;
	def.aktualizacja = false;
	def.publ = {};
	def.priv = {};

	def.priv.thread = function(){
		console.log('thread');
		$.ajax({
			url: '/scada/raport',
			dataType : 'json',
			async: false,
			success : function (response, status, xhr){
				console.log('scada.raport.success');
				console.log(response);
				console.log(status);
				console.log(xhr);
			},
			error : function(jqXHR, status, error){
				console.error('scada.raport.error');
				console.log(jqXHR)
				console.log(status);
				console.log(error);
			}

		})
	};

	def.priv.init = function (){
		def.run = setInterval(def.priv.thread,1000,def);
	};

	def.priv.init();
	return def.publ;
};
//scada.Application.prototype.priv = {};
//scada.Application.prototype.publ = {};
//scada.Application.inf = {};
//scada.Application.inf.priv = scada.Application.prototype.priv;
//scada.Application.inf.publ = scada.Application.prototype.publ;
//scada.Application.inf.priv.thread = function(){
//	console.log()
//}