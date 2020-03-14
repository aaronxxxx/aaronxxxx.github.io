-(function(a,b){
  "use strict"
    b.fn.extend({
    animateIncrement : function(obj){
      var setting = b.extend({
        delay : 1000,
        perTime : 30,
        valueSelector : ".increment",
        barSelector : ".progress",
        barsWidth  : [100,150],
        timeReg : /\'|\`|\,|\:/g
      },obj),
        $s = this,
        renderTop = this.offset().top - b(a).height(); 
      if($s.length == 0)throw "Can't Render Animate Increment , Because Not Found Target";  
      b(a).on("scroll",void_renderFooterAnimate);  
      function void_renderFooterAnimate(){
        var $this = b(this),
            r = renderTop - $this.scrollTop();
        if(r<0){
          $this.unbind("scroll",void_renderFooterAnimate);
          
          void_startFooterAnimate($s,setting);
        }
      }
      function void_startFooterAnimate($s,obj){
        
        var $sValues = $s.find(obj.valueSelector),
          $sBars =$s.find(obj.barSelector),
          i = 0 , fp = 100 , pr = Math.floor(obj.delay/obj.perTime),
          maxI = fp + (($sValues.length-1)*pr); 
        $sValues.seArray = $sValues.map(function(){
          var str = b.trim(b(this).text()),
            reg = obj.timeReg,
            sec = parseInt(str);
          if(str.match(reg)){
            var tmpArray = str.split(reg);
            sec = 0;
            for(var a in tmpArray){
              var multiplier = Math.pow(60,(tmpArray.length-1 - parseInt(a)));
              sec += parseInt(tmpArray[a]) * multiplier;
            }
          }
          return sec;
        }).get();
        $sValues.seArray.getResultWithPercent = function(m,i){
          var rp = parseInt( i * this[m] / fp ),
            str = String(rp);
          if(rp>=60)str = Math.floor(rp / 60) + "`" + rp % 60;
          return str;
        }
        $sBars.seArray = obj.barsWidth;
        
        var timer = setInterval(function(){
          var t = i++ * obj.perTime;
          line($sValues,$sBars,0,i);
          if(t>=obj.delay)line($sValues,$sBars,1,i);
          if(t>=obj.delay*2)line($sValues,$sBars,2,i);
          
          if(i>maxI){clearInterval(timer);return false;}
        },obj.perTime);
        
        $sValues.text("");
        
        function line(t,b,m,i){
          var cfp = i - (m*pr);
          if(cfp>fp)return false;
          t.eq(m).text(t.seArray.getResultWithPercent(m,cfp));
          if(b.eq(m).length>0){
            b.eq(m).css({width: parseInt( cfp * b.seArray[m] / fp )});
          }
        }
        
      }
      return this;
    },
    hoverImageWith : function(atf){
      var origionAttr = "oi";
      this.unbind('mouseenter').unbind('mouseleave').hover(mouseIn,mouseOut).each(function(e){
        var $e = b(this);
        $e.attr(origionAttr,$e.attr("src"));
        $e = null;
      });
      function mouseIn(e){
        var $this = b(this),
            srcArray = $this.attr(origionAttr).split("/"),_src,
            hoverAttr = (typeof atf == 'function')?atf.apply(this,[$this.attr("src")]):$this.attr(atf);
        if(hoverAttr.match(/[\/]+/g)){
          _src = hoverAttr;
        }else{
          srcArray[srcArray.length-1] = hoverAttr;
          _src = srcArray.join("/");
        }
        $this.attr("src",_src);
      }
      function mouseOut(e){
        var $this = b(this);
        $this.attr("src",$this.attr(origionAttr));
      }
      return this;
    },
    animateFloatBlock : function(obj){
      var setting = b.extend({
        actionSelector : this,
        actionEvent : "none",
        actionArray : ["hover","click","none"],
        actionCss : 0,
        position : "none",
        positionArray : ["left","right","top","bottom","none"],
        animateTime : 1000,
        transitionTime : ".35s",
        toggleClassName : "on",
        gapTopWithWindowDivisor : null,
        is : function(){
          return b.inArray(this.position,this.positionArray)>=0 && b.inArray(this.actionEvent,this.actionArray)>=0;
        }
      },obj);
      if(!setting.is())throw "not has delimit";
      var $tf = this,
          floatHeight = this.height();
          
      //setting.isIE8 = a.getIEVersion() <= 8;
      
      b(a).on("scroll resize",function(e){
        var $this = b(this),
            scrollTop = $this.scrollTop(),
            _top = (setting.gapTopWithWindowDivisor) ? ($this.height() / setting.gapTopWithWindowDivisor) + scrollTop : ($this.height() - floatHeight) / 2 + scrollTop;
        $tf.stop().animate({top:_top},setting.animateTime);
      }).resize();
      
      if(setting.position!="none")void_OnAction($tf,setting);
      
      function void_OnAction($tf,obj){
        $tf.css("transition",obj.position + " " + obj.transitionTime + " ease-out");
        $tf.origionCss = $tf.css(obj.position);
        var $tff = (typeof obj.actionSelector == String) ? $tf.find(obj.actionSelector) : $tf;
        
        switch(obj.actionEvent){
          case "click":
            $tff.on(obj.actionEvent,function(e){
              var css = (!$tf.hasClass(obj.toggleClassName))?obj.actionCss:$tf.origionCss;
              //if(obj.isIE8)
              $tf.toggleClass(obj.toggleClassName).css(obj.position,css);
            });
            break;
          case "hover":
            $tff.unbind('mouseenter').unbind('mouseleave').hover(
            function(e){
              //if(obj.isIE8)
              $tf.css(obj.position,obj.actionCss).addClass(obj.toggleClassName);
            },
            function(e){
              //if(obj.isIE8)
              $tf.css(obj.position,$tf.origionCss).removeClass(obj.toggleClassName);
            });
            break;
        }
      
      }
      return this;
    }
  });
  
}(window || this , jQuery));