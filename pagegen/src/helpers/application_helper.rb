module ApplicationHelper
  def text(id, label)
    partial('text', :locals => { :id => id, :label => label })
  end
  
  def password(id, label)
    partial('text', :locals => { :id => id, :label => label, :inputtype => 'password' })
  end
  
  def date(id, label)
    partial('date', :locals => { :id => id, :label => label })    
  end
  
  def radio(id, label, options)
    partial('radio', :locals => { :id => id, :label => label, :options => options })
  end
  
  def select(id, label, options)
    partial('select', :locals => { :id => id, :label => label, :options => options })
  end
  
  def checkbox(id, label, options)
    partial('checkbox', :locals => { :id => id, :label => label, :options => options })
  end
  
  def label(id, label, class_name=nil)
    partial('label', :locals => { :id => id, 
                                  :label => label, 
                                  :class_name => class_name })
  end
  
  def textarea_sm(id, label)
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 30,
                                     :rows => 3 })
  end

  def textarea_med(id, label)
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 40,
                                     :rows => 5 })
  end

  def textarea_lg(id, label)
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 70,
                                     :rows => 12 })
  end
  
  def daterange(id, label)
    partial('daterange', :locals => { :id => id, :label => label })
  end
  
  def bool(id, label)
    partial('bool', :locals => { :id => id, :label => label })
  end
  
  def boolplus(id, label)
    partial('boolplus', :locals => { :id => id, :label => label })
  end
  
  def reference(id, label)
    partial('reference', :locals => { :id => id, :label => label })
  end
  
  def attachment(id, label)
    partial('attachment', :locals => { :id => id, :label => label })
  end
end