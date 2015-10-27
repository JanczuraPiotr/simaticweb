'use strict';
console.log('scada.panel.js');

scada.Panel = function(){
	var def = this;
	def.aktualizacja = false;
	def.elementInEdit = null;
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
		0 : {
			0 : 0,
			1 : 0,
			2 : 0,
			3 : 0,
			4 : 0,
			5 : 0
		}
	};

	def.priv.newD = function(D){
		if(D.Byte !== def.D.Byte && def.elementInEdit !== scada.cf.panel.variables.byte.me.el){
			def.D.Byte = D.Byte;
			$('#d-byte-input').val(D.Byte);
		}
		if(D.Int !== def.D.Int && def.elementInEdit !== scada.cf.panel.variables.int.me.el){
			def.D.Int = D.Int;
			$('#d-int-input').val(D.Int);
		}
		if(D.DInt !== def.D.DInt && def.elementInEdit !== scada.cf.panel.variables.real.me.el){
			def.D.DInt = D.DInt;
			$('#d-dint-input').val(D.DInt);
		}
		if(D.Real !== def.D.Real && def.elementInEdit !== scada.cf.panel.variables.real.me.el){
			def.D.Real = D.Real;
			$('#d-real-input').val(D.Real);
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
//				console.log(jqXHR)
//				console.log(status);
//				console.log(error);
			}

		})
	};
	def.priv.onButtonD = function(selector, eventTypem, handler){
//		console.info(selector);
//		console.info(eventTypem);
//		console.info(handler);

		var memType = S7.D;
		var varType = $(this).parent().parent().find('input').data('var-type');
		var varCode = $(this).parent().parent().find('input').data('var-code');
		var varVal = $(this).parent().parent().find('input').val();


		$.ajax({
			url : 'set-d',
			dataType : 'json',
			async : false,
			data : {
				memType : memType,
				varType : varType,
				varCode : varCode,
				varVal  : varVal
			},
			success : function(response,status,xhr){
				// @todo obsłóż
//				console.log('scada.d.set.success');
//				console.log(response);
//				console.log(status);
			},
			error : function(jqXHR, status, error){
				// @todo obsłóż
				console.error('scada.d.set.error');
//				console.log(jqXHR)
//				console.log(status);
//				console.log(error);
			}
		});

	};
	def.priv.onClickQ = function(selector, eventType,handler){
		var memType = S7.Q;
		var varCode = 0; // @todo pobrać kod zmiennej z SimaticServer
		var port = $(this).data('port');
		var bit = $(this).data('bit');
		var onOff;

		if( $(this).prop('checked') ){
			onOff = 1;
		}else{
			onOff = 0;
		}

		$.ajax({
			url : 'switch-port',
			contentType: 'application/json; charset=UTF-8',
			dataType:'json',
			async : false,
			data : {
				memType : memType,
				varCode : varCode,
				port    : port,
				bit     : bit,
			},
			success : function(response,status,xhr){
				// @todo obsłóż
				console.log('scada.port.set.success');
//				console.log(response);
//				console.log(status);
			},
			error : function(jqXHR, status, error){
				// @todo obsłóż
				console.error('scada.port.set.error');
//				console.log(jqXHR)
//				console.log(status);
//				console.log(error);
			}
		});
	}
	def.priv.inputStartEdit = function(event){
		def.elementInEdit = event.target.id;
	}
	def.priv.inputStopEdit = function(event){
		def.elementInEdit = null;
	}

	def.priv.init = function (){
		$(scada.cf.panel.outputs.me.id).delegate('.output','click',def.priv.onClickQ);
		$(scada.cf.panel.variables.me.id).delegate('button','click',def.priv.onButtonD);
		$(scada.cf.panel.variables.me.id).delegate('input[type=text]','keypress',def.priv.inputStartEdit);
		$(scada.cf.panel.variables.me.id).delegate('input[type=text]','blur',def.priv.inputStopEdit);
		def.run = setInterval(def.priv.thread,scada.cf.panel.me.refreshInterval_ms,def);
	};


	def.priv.init();
	return def.publ;
};