require 'haml'
require 'pp'

configuration.haml_options = {
    :attr_wrapper => '"',
    :extension => 'php'
}

module PHP
    include Haml::Filters::Base
    
    def render(text)
        "<?php #{text} ?>"
    end
end
