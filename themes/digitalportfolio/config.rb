# Basic settings for compass.

http_path 		= "/"
css_dir 		= "css"
sass_dir		= "css/sass"
images_dir		= "images"
javascript_dir	= "js"

# You can select your preferred output style here (can be overridden via the command line):
output_style	= :expanded
environment		= :development

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# comline_comments	= true


# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass sass scss && rm -rf sass && mv scss sass



# Moves style.css to the root of our theme when style.css is saved.

# WARNING: the below code doesn't agree with autoprefixer and removes whatever it adds:

# require 'fileutils'
# on_stylesheet_saved do |file|
#   if File.exists?(file) && File.basename(file) == "style.css"
#   puts "Moving: #{file}"
#   FileUtils.mv(file, File.dirname(file) + "/../" + File.basename(file))
#   end
# end


# Adds font awesome sass version to compass.
require 'font-awesome-sass'

