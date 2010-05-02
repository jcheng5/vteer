require 'csv'

module ApplicationHelper

  def default_validation(id, required)
    partial('default_validation', :locals => { :id => id }) if required
  end

  def text(id, label, config={})
    partial('text', :locals => { :id => id, :label => label, :required => config[:required], :config => config })
  end
  
  def password(id, label, config={})
    partial('text', :locals => { :id => id, :label => label, :inputtype => 'password', :required => config[:required] })
  end
  
  def date(id, label, config={})
    partial('date', :locals => { :id => id, :label => label, :required => config[:required] })    
  end
  
  # year_offset determines the range of years to show the user--from now to
  # ([current year] + year_offset). It can be positive or negative.
  def date_raw(id, year_offset, config={})
    partial('date_raw', :locals => { :id => id,
                                     :year_offset => year_offset,
                                     :required => config[:required],
                                     :config => config })
  end
  
  def radio(id, label, options, config={})
    partial('radio', :locals => { :id => id, :label => label, :options => options, :required => config[:required] })
  end
  
  def select(id, label, options, config={})
    partial('select', :locals => { :id => id, :label => label, :options => options, :required => config[:required] })
  end
  
  def checkbox(id, label, options, config={})
    partial('checkbox', :locals => { :id => id, :label => label, :options => options, :required => config[:required], :config => config })
  end
  
  def label(id, label, config={})
    partial('label', :locals => { :id => id, 
                                  :label => label, 
                                  :class_name => config[:class_name],
                                  :required => config[:required],
                                  :config => config })
  end
  
  def textarea_sm(id, label, config={})
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 30,
                                     :rows => 3,
                                     :size => 'small',
                                     :required => config[:required],
                                     :config => config })
  end

  def textarea_med(id, label, config={})
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 40,
                                     :rows => 5,
                                     :size => 'medium',
                                     :required => config[:required],
                                     :config => config })
  end

  def textarea_lg(id, label, config={})
    partial('textarea', :locals => { :id => id,
                                     :label => label,
                                     :cols => 70,
                                     :rows => 12,
                                     :size => 'large',
                                     :required => config[:required],
                                     :config => config })
  end
  
  def daterange(id, label, config={})
    partial('daterange', :locals => { :id => id, :label => label, :required => config[:required], :config => config })
  end
  
  def bool(id, label, config={})
    partial('bool', :locals => { :id => id, :label => label, :required => config[:required] })
  end
  
  def boolplus(id, label, config={})
    partial('boolplus', :locals => { :id => id, :label => label, :required => config[:required] })
  end
  
  def reference(id, label, config={})
    partial('reference', :locals => { :id => id, :label => label, :required => config[:required] })
  end
  
  def attachment(id, label, config={})
    partial('attachment', :locals => { :id => id, :label => label, :required => config[:required] })
  end
  
  def volunteer_positions(id, label, config={})
    positions = CSV.read('pagegen/src/positions.csv')
    partial('volunteer_positions', :locals => { :id => id, :label => label, :required => config[:required], :config => config, :positions => positions })
  end
end