'use strict';
console.log('scada.panel.js');

scada.Panel = function(){
	var def = this;
	def.aktualizacja = false;
	def.publ = {};
	def.priv = {};
	// zmienne
	def.D = {
		Byte : 0,
		Int  : 0,
		DInt : 0,
		Real : 0,
	};
	 // wejścia
	def.I = {
		// port 0
		0 : {
			0 : 0,
			1 : 0,
			2 : 0,
			3 : 0,
			4 : 0,
			5 : 0,
			6 : 0,
			7 : 0,
		}
	};
	// wyjścia
	def.Q = {
		0 : 0,
		1 : 0,
		2 : 0,
		3 : 0,
		4 : 0,
		5 : 0
	};

	def.priv.newD = function(D){
		if(D.Byte !== def.D.Byte){
			def.D.Byte = D.Byte;
			$('#d-byte').val(D.Byte);
		}
		if(D.Int !== def.D.Int){
			def.D.Int = D.Int;
			$('#d-int').val(D.Int);
		}
		if(D.DInt !== def.D.DInt){
			def.D.DInt = D.DInt;
			$('#d-dint').val(D.DInt);
		}
		if(D.Real !== def.D.Ral){
			def.D.Real = D.Real;
			$('#d-real').val(D.Real);
		}
	};
	def.priv.newI = function(I){
		var port;
		var bit;
		for (port in I){
			for( bit in I[port]){
				if(def.I[port][bit] !== I[port][bit]){
					def.I[port][bit] = I[port][bit];
					if( I[port][bit] == 1){
						$('#i-'+port+'-'+bit).prop('checked',true);
					}else{
						$('#i-'+port+'-'+bit).prop('checked',false);
					}
				}
			}
		}
	};
	def.priv.newQ = function(Q){
		var port;
		var bit;
		for (port in Q){
			for( bit in Q[port]){
				if(def.Q[port][bit] !== Q[port][bit]){
					def.Q[port][bit] = Q[port][bit];
					if( Q[port][bit] == 1){
						$('#q-'+port+'-'+bit).prop('checked',true);
					}else{
						$('#q-'+port+'-'+bit).prop('checked',false);
					}
				}
			}
		}
	};
	def.priv.thread = function(){
		console.log('thread');
		$.ajax({
			url: '/scada/raport',
			dataType : 'json',
			async: false,
			success : function (response, status, xhr){
				def.priv.newD(response.D);
				def.priv.newI(response.I);
				def.priv.newQ(response.Q);
			},
			error : function(jqXHR, status, error){
				console.error('scada.raport.error');
				console.log(jqXHR)
				console.log(status);
				console.log(error);
			}

		})
	};

	def.priv.onClickQ = function(selector, eventType,handler){
		var port = $(this).data('port');
		var bit = $(this).data('bit');
		var onOff;

		if( $(this).prop('checked') ){
			onOff = 1;
		}else{
			onOff = 0;
		}

		$.ajax({
			url : 'set-port',
			contentType: 'application/json; charset=UTF-8',
			dataType:'json',
			async : false,
			data : {
				port  : port,
				bit   : bit,
				onOff : onOff
			},
			success : function(response,status,xhr){
				console.log('scada.port.set.success');
				console.log(response);
				console.log(status);
			},
			error : function(jqXHR, status, error){
				console.error('scada.port.set.error');
				console.log(jqXHR)
				console.log(status);
				console.log(error);
			}
		});
	}

	def.priv.init = function (){
		$('#outputs').delegate('.output','click',def.priv.onClickQ);
		def.run = setInterval(def.priv.thread,scada.config.panel.refreshInterval_ms,def);
	};


	def.priv.init();
	return def.publ;
};