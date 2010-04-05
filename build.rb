#!/usr/bin/ruby

require 'rubygems'

begin
  require 'staticmatic'
rescue Exception => e
  puts "Couldn't load staticmatic--do you have the gem installed?"
  exit 1
end

print `staticmatic build pagegen`

print `cp pagegen/site/stylesheets/application.css www/static/css/application.css`
(1..6).each do |i|
  print `cp pagegen/site/page#{i}.html www/system/application/views/apply/page#{i}.php`
end
puts "Copied output to www"
