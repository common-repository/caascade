=== Caascade ===
Contributors: pmagunia
Tags: math,education,shortcode
Requires at least: 3.9.2
Tested up to: 4.5.2
Stable tag: trunk
License: GPLv2  or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Caascade allows users to request output from the Maxima CAS and PHP algorithms.

== Description ==

Contributor's Note: this project has been abandoned and is no longer supported.

Caascade is a free Computation-as-a-Service API. Using Wordpress Shortcode, this plugin allows forms to be embedded for various mathematical operations. Users can enter expressions which are evaluated by a Caascade server. The Caascade plugin may be useful to bloggers and other web publishers who would like their readers to interact with their site's mathematical content.

Tetragy welcomes requests for new operations that may be specific to a user or organization. A demo of this WordPress plugin is available at https://wp.tetragy.com. The Maxima backend may be cloned with the Github repository. Visit https://math.tetragy.com/ for additional details!

The current version of the plugin provides for the following operations:

Arithmetic

- add
- subtract
- multipliy
- divide
- exponent
- factorial
- double factorial
- modulus operator
- beta & gamma functions
- is greater than
- is greater than or equal to
- is less than
- is less than or equal to

Algebra

- expand
- factor
- evaluate
- distribute over
- absolute value
- factor out
- polynomial divide
- square root
- solve
- allroots

Number Theory

- prime
- greatest common divisor
- isint
- isodd
- iseven
- asksign

Plotting

- plot2d
- plot3d
- contour plot
- implicit plot
- parametric plot

Calculus

- defint
- derivative
- integrate
- limit
- summation
- product
- La Place transform

Trigonometry

- arc cosine
- hyperbolic arc cosine
- arc cotangent
- hyperbolic cotangent
- arc secant
- hyperbolic arc cosecant
- arc secant
- hyperbolic arc secant
- arc sine
- hyperbolic arc sine
- arc cotangent
- hyperbolic arc cotangent
- cosine
- hyperbolic cosine
- cotangent
- hyperbolic cotangent
- cosecant
- hyperbolic cosecant
- exponential function
- natural logarithm
- secant
- hyperbolic secant
- sine
- hyperbolic sine
- tangent
- hyperbolic tangent

Miscellaneous

- floor
- ceiling
- random

Matrix

- Matrix add
- Matrix multiply
- Determinant
- Invert matrix

== Installation ==

1. Download and enable the Caascade and Simple-MathJax plugins which are extracted to the `/wp-content/plugins/` directory.
2. Use Shortcode in your posts to include a Caascade operation. For example: `[caascade com="prime"]`.

A demonstration of select operations can be found at http://wp.tetragy.com/.

Visit https://math.tetragy.com/ for additional documentation.

== Frequently Asked Questions ==

= How much does it cost ? =

All computation requests with optional PDF output are free.

= Do I need Maxima installed on my server ? =

No, WordPress and Caascade plugins are the only software requirements. The Simple-MathJax plugin is necessary for TeX rendering.

= Where can I try a demo ? =

https://wp.tetragy.com

See https://math.tetragy.com for additional documentation.

= Can I create my own operations ? =

Yes, clone the TServer Github repository and add your own code. https://github.com/pmagunia/tserver.

References

- http://maxima.sourceforge.net
- http://www.latex-project.org
- http://www.mathjax.org
- https://math.tetragy.com

== Screenshots ==

1. Test of primality operation on the integer '113'
2. plot3D screenshot of log(x) on (-1,1)
3. plot2D screenshot of log(x) on (-1,1)
4. Caascade UI
5. Caascade syntax for including operation on a page or post
6. PDF of Caascade output

== Changelog ==

= 1.8.2 =
* Allow multiple simultaneous requests per page
* Override default CSS
* Remove Recaptcha
* Remove need for a Caascade ID
* Add custom.html to provide a template for new operations
* New operations: Matrix add, Matrix multiply, determinant, invert, mod operator

= 1.8.1 =
* Add CSS line for recaptcha table for newer WP themes
* Change wording of Caascade settings page
* New operation: base

= 1.8.0 =
* New operation: lcm1
* Drop MathJax-LaTeX support in favor of Simple-Mathjax

= 1.7.0 =
* New feature: Override default CSS and JS files

= 1.6.0 =
* MathJax-LaTeX plugin now required
* Add caascade-2d CSS class
* Added equal sign to isequal operation for clarity
* New operations: allroots, beta, gamma, laplace, solve

= 1.5.0 =
* switch from POST to GET and jsonp
* localize JavaScript pubkey variable
* correct Recaptcha message on misconfiguration
* Check Recaptcha classes existing before including
* minor CSS changes
* clarify README.txt and UI
* inline approximate support
* double factorial
* factorial
* absolute Value
* distribute over
* summation
* product
* greatest common divisor
* floor
* ceiling
* arc cosine
* hyperbolic arc cosine
* arc cotangent
* hyperbolic cotangent
* arc secant
* hyperbolic arc cosecant
* arc secant
* hyperbolic arc secant
* arc sine
* hyperbolic arc sine
* arc cotangent
* hyperbolic arc cotangent
* cosine
* hyperbolic cosine
* cotangent
* hyperbolic cotangent
* cosecant
* hyperbolic cosecant
* exponential function
* natural logarithm
* random
* secant
* hyperbolic secant
* sine
* hyperbolic sine
* square root
* tangent
* hyperbolic tangent
* isint
* isodd
* iseven
* asksign
* contour plot
* implicit plot
* parametric plot
* factorout

= 1.3.1 =
* Fix bug where Recaptcha keys with hypen may not be saved 

= 1.3.0 =
* Recaptcha support
* Summation and product operations
* Inline PDF support

= 1.2.0 =
* Add override feature so customized code is not lost with plugin upgrade
* Support multiple operations on the same page
* Remove tab whitespace for repository browsing
* Improve class and and id attribute structuring
* Update MathJax CDN address
* Plot2D and Plot3D

= 1.1.2 =
* Add arithmetic operators

= 1.1.1 =
* Fix Author URI
* Clarify README.txt
* Add MathJax as a dependency for the `caascade.js` script

= 1.1 = 
* Add PDF functionality
* CSS improvements
* add evaluate operation

= 1.0 = 
* Initial commit


== Upgrade Notice ==

= 1.8.2 =
No security updates
New operations (Matrix and mod operator)
Recaptcha is no longer supported in latest version. Previous versions should continue to function.
New custom.html operation for use with user-defined operations (requires TServer)

= 1.8.1 =
CSS Bug fix for Recaptcha
Change wording of settings page
New operation: base

= 1.8.0 =
New operations

= 1.7.0 =
Upgrade for admins who would like to override default CSS and JS files with their own files. Place new files in `html/override` directory to automatically replace packaged files.

= 1.6.0 =

New operations
MathJax-LaTeX plugin support (required)
Minor CSS & text edits

= 1.5.0 =

Plotting API changes
Bug fix: Correct Recaptcha message on misconfiguration
Bug fix: Check Recaptcha class exists before declaring
New operations: see Changelog
New feature: Inline approximate, Under-the-hood changes
Improve verbiage

= 1.3.1 =

Necessary for certain Recaptcha users

= 1.3.0 =

Recommended for users who need recaptcha and inline PDF options

= 1.2.0 =

Recommended for users who want to display multiple blocks. New plotting operations.

= 1.1.2 =

Arithmetic operators

= 1.1.1 =

No functional changes. Minor improvement to documentation and JS enqueue

= 1.1 =

Recommended for all users. New features and stability improvements.

= 1.0 =

Initial commit

