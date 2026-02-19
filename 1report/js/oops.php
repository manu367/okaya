<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Functions Guide</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- Header -->
    <h1 class="text-3xl md:text-4xl font-bold text-center mb-3">
        CSS Functions
    </h1>

    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-10">
        CSS functions are built-in tools that help calculate values, define colors,
        load images, and create dynamic responsive designs.
    </p>


    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">var()</h2>
            <p class="text-sm mb-3">Gets value from a CSS variable. Useful for themes and reusable colors.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">color: var(--main-color);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">calc()</h2>
            <p class="text-sm mb-3">Performs mathematical calculations inside CSS.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">width: calc(100% - 50px);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">rgb() / rgba()</h2>
            <p class="text-sm mb-3">Defines colors using Red, Green, Blue values. RGBA adds transparency.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                color: rgb(255,0,0);<br>
                color: rgba(255,0,0,0.5);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">url()</h2>
            <p class="text-sm mb-3">Loads external files like images or fonts.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                background-image: url("image.jpg");
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">linear-gradient()</h2>
            <p class="text-sm mb-3">Creates smooth color transitions in a direction.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                background: linear-gradient(to right, red, blue);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">clamp()</h2>
            <p class="text-sm mb-3">Sets minimum, preferred, and maximum value — perfect for responsive font sizes.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                font-size: clamp(16px, 5vw, 40px);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">min()</h2>
            <p class="text-sm mb-3">Chooses the smallest value from given options.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                width: min(500px, 90%);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">max()</h2>
            <p class="text-sm mb-3">Chooses the largest value from given options.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                width: max(300px, 50%);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">lab()</h2>
            <p class="text-sm mb-3">Modern perceptual color space for more accurate color rendering.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                color: lab(50% 40 30);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">attr()</h2>
            <p class="text-sm mb-3">Reads values from HTML attributes.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                content: attr(data-title);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">counter()</h2>
            <p class="text-sm mb-3">Used with CSS counters for automatic numbering.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                content: counter(section);
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="font-semibold text-xl mb-2">image-set()</h2>
            <p class="text-sm mb-3">Loads responsive images for different screen densities.</p>
            <code class="text-sm bg-gray-100 p-2 block rounded">
                background-image: image-set("img1.jpg" 1x, "img2.jpg" 2x);
            </code>
        </div>

    </div>

</div>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Variables (Custom Properties)</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS Variables (also called Custom Properties) reusable values hote hain jo ek baar define karke
        poori website me use kiye ja sakte hain. Ye theme colors, spacing, fonts, and responsive design
        manage karne ke liye best practice maana jata hai.
    </p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Define Variable -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Define Variable</h3>
            <p class="text-sm mb-3">Variables usually <code>:root</code> me define ki jati hain global use ke liye.</p>
            <code class="text-sm bg-gray-100 p-2 rounded block">
                :root { <br>
                &nbsp;&nbsp;--main-color: blue;<br>
                }
            </code>
        </div>

        <!-- Use Variable -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Use Variable</h3>
            <p class="text-sm mb-3">Variable ko <code>var()</code> function se call karte hain.</p>
            <code class="text-sm bg-gray-100 p-2 rounded block">
                color: var(--main-color);
            </code>
        </div>

        <!-- With Fallback -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Fallback Value</h3>
            <p class="text-sm mb-3">Agar variable na mile to backup value use hoti hai.</p>
            <code class="text-sm bg-gray-100 p-2 rounded block">
                color: var(--main-color, red);
            </code>
        </div>

        <!-- Scoped Variables -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Scoped Variables</h3>
            <p class="text-sm mb-3">Variables kisi specific class ya section ke andar bhi define ho sakti hain.</p>
            <code class="text-sm bg-gray-100 p-2 rounded block">
                .card {<br>
                &nbsp;&nbsp;--card-color: green;<br>
                }
            </code>
        </div>

        <!-- Change with Media Query -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Responsive Variables</h3>
            <p class="text-sm mb-3">Media query ke andar variable change karke responsive design bana sakte ho.</p>
            <code class="text-sm bg-gray-100 p-2 rounded block">
                @media (max-width:600px){<br>
                &nbsp;&nbsp;:root{ --font:14px; }<br>
                }
            </code>
        </div>

        <!-- Why Use -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">Why Use Variables?</h3>
            <ul class="text-sm list-disc ml-4 space-y-1">
                <li>Easy theme change</li>
                <li>Reusable values</li>
                <li>Cleaner CSS</li>
                <li>Better maintenance</li>
            </ul>
        </div>

    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Transition</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        A CSS transition lets you change CSS property values smoothly over time instead of instantly.
        Without transition the change feels sudden, but with transition the browser animates the change
        step-by-step, creating a soft visual effect. Transitions are commonly used for hover effects,
        buttons, cards, menus, and UI interactions.
    </p>

    <!-- Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>
        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector {<br>
            &nbsp;&nbsp;transition: property duration timing-function delay;<br>
            }
        </code>
        <p class="text-sm text-gray-600 mt-3">
            This shorthand defines what property should animate, how long it runs,
            how the speed behaves, and when it should start.
        </p>
    </div>


    <!-- Properties Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">

        <!-- property -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">1. transition-property</h3>
            <p class="text-sm mb-3">
                Defines which CSS property will animate. If not specified correctly,
                the transition will not run.
            </p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transition-property: width;
            </code>

            <p class="text-sm mt-3"><strong>Tip:</strong> Use <code>all</code> to animate everything.</p>

            <code class="bg-gray-100 p-2 rounded block text-sm mt-2">
                transition-property: all;
            </code>
        </div>


        <!-- duration -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">2. transition-duration</h3>
            <p class="text-sm mb-3">
                Sets how long the animation takes to complete. Required property —
                without duration, transition won't be visible.
            </p>

            <code class="bg-gray-100 p-2 rounded block text-sm">
                transition-duration: 1s;
            </code>

            <p class="text-sm mt-3">
                You can use seconds (<code>s</code>) or milliseconds (<code>ms</code>).
            </p>
        </div>


        <!-- timing -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">3. transition-timing-function</h3>

            <p class="text-sm mb-3">
                Controls animation speed curve — meaning how the motion accelerates or slows.
            </p>

            <code class="bg-gray-100 p-2 rounded block text-sm">
                transition-timing-function: ease;
            </code>

            <div class="text-sm mt-3 space-y-1">
                <div><strong>ease</strong> → slow start, fast middle, slow end (default)</div>
                <div><strong>linear</strong> → constant speed</div>
                <div><strong>ease-in</strong> → slow start</div>
                <div><strong>ease-out</strong> → slow end</div>
                <div><strong>ease-in-out</strong> → slow start & end</div>
            </div>
        </div>


        <!-- delay -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">4. transition-delay</h3>

            <p class="text-sm mb-3">
                Defines how long the browser waits before starting the transition.
            </p>

            <code class="bg-gray-100 p-2 rounded block text-sm">
                transition-delay: 0.5s;
            </code>

            <p class="text-sm mt-3">
                Useful for staggered animations or hover effects that start after a pause.
            </p>
        </div>

    </div>


    <!-- Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Complete Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            button {<br>
            &nbsp;&nbsp;background: blue;<br>
            &nbsp;&nbsp;transition: background 0.4s ease 0s;<br>
            }<br><br>

            button:hover {<br>
            &nbsp;&nbsp;background: red;<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            When the user hovers the button, the color smoothly changes instead of switching instantly.
        </p>
    </div>

</section>
<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Animation</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS Animation lets elements move, change, rotate, fade, or transform automatically
        without needing hover or click. Unlike transitions, animations can start on their own,
        repeat forever, contain multiple steps, change direction, and even be paused or resumed.
        They are widely used for loaders, banners, sliders, UI highlights, and interactive visuals.
    </p>


    <!-- Two Parts -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">1. @keyframes (Define Steps)</h3>
            <p class="text-sm mb-3">
                <code>@keyframes</code> defines how the animation changes from start to end.
                You can use <strong>from → to</strong> OR <strong>0% → 100%</strong>.
            </p>

            <code class="bg-gray-100 p-3 rounded block text-sm">
                @keyframes moveBox {<br>
                &nbsp;from { transform: translateX(0); }<br>
                &nbsp;to { transform: translateX(200px); }<br>
                }
            </code>

            <code class="bg-gray-100 p-3 rounded block text-sm mt-3">
                @keyframes moveBox {<br>
                &nbsp;0% { transform: translateX(0); }<br>
                &nbsp;100% { transform: translateX(200px); }<br>
                }
            </code>
        </div>


        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-2">2. Apply Animation</h3>

            <p class="text-sm mb-3">
                After defining keyframes, attach the animation to an element
                using the <code>animation</code> property.
            </p>

            <code class="bg-gray-100 p-3 rounded block text-sm">
                .box {<br>
                &nbsp;animation: moveBox 2s ease;<br>
                }
            </code>

            <p class="text-sm text-gray-600 mt-3">
                This runs the <strong>moveBox</strong> animation for 2 seconds with smooth speed.
            </p>

        </div>

    </div>


    <!-- Properties -->
    <h3 class="text-xl font-semibold mb-4">Animation Properties</h3>

    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">animation-name</h4>
            <p class="text-sm mb-2">Specifies which keyframe animation to use.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">animation-name: moveBox;</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">animation-duration</h4>
            <p class="text-sm mb-2">Defines how long one animation cycle takes.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">animation-duration: 2s;</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">animation-timing-function</h4>
            <p class="text-sm mb-2">Controls the speed curve (ease, linear, ease-in, etc.).</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">animation-timing-function: ease;</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">animation-delay</h4>
            <p class="text-sm mb-2">Sets waiting time before animation starts.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">animation-delay: 1s;</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">animation-iteration-count</h4>
            <p class="text-sm mb-2">Defines how many times animation runs.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                animation-iteration-count: infinite;
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">Shorthand Property</h4>
            <p class="text-sm mb-2">You can combine everything in one line.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                animation: moveBox 2s ease 1s infinite;
            </code>
        </div>

    </div>


    <!-- Multi-step Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Multi-Step Animation Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            @keyframes colorMove {<br>
            &nbsp;0% { background:red; transform:translateX(0); }<br>
            &nbsp;50% { background:blue; transform:translateX(100px); }<br>
            &nbsp;100% { background:green; transform:translateX(0); }<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            This animation changes both position and color with multiple steps.
        </p>
    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Filter</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        The CSS <strong>filter</strong> property lets you apply visual effects to elements
        like images, backgrounds, or containers. You can blur, change brightness,
        adjust contrast, add shadows, or convert colors — similar to photo editing tools.
        Filters are commonly used for image hover effects, UI styling, overlays,
        and modern card designs.
    </p>


    <!-- Basic Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector {<br>
            &nbsp;filter: value;<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Multiple filters can be combined by separating them with spaces.
        </p>

        <code class="bg-gray-100 p-3 rounded block text-sm mt-2">
            filter: blur(3px) brightness(120%);
        </code>

    </div>


    <!-- Filter Types -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">blur(px)</h4>
            <p class="text-sm mb-2">Makes the element blurry.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: blur(4px);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">brightness(%)</h4>
            <p class="text-sm mb-2">Controls light intensity.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: brightness(150%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">contrast(%)</h4>
            <p class="text-sm mb-2">Adjusts difference between dark & light.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: contrast(120%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">grayscale(%)</h4>
            <p class="text-sm mb-2">Converts colors into black & white.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: grayscale(100%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">sepia(%)</h4>
            <p class="text-sm mb-2">Adds warm vintage brown tone.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: sepia(80%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">saturate(%)</h4>
            <p class="text-sm mb-2">Controls color intensity.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: saturate(200%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">hue-rotate(deg)</h4>
            <p class="text-sm mb-2">Shifts all colors around the color wheel.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: hue-rotate(90deg);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">invert(%)</h4>
            <p class="text-sm mb-2">Inverts colors (light ↔ dark).</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">filter: invert(100%);</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">drop-shadow()</h4>
            <p class="text-sm mb-2">Adds shadow following the image shape.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                filter: drop-shadow(5px 5px 10px gray);
            </code>
        </div>

    </div>


    <!-- Hover Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Hover Effect Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            img {<br>
            &nbsp;filter: grayscale(100%);<br>
            &nbsp;transition: 0.4s;<br>
            }<br><br>

            img:hover {<br>
            &nbsp;filter: grayscale(0%);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Image starts black-and-white and smoothly returns to full color on hover.
        </p>
    </div>

</section>
<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Masking</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS Masking lets you hide or reveal parts of an element using another image,
        gradient, or shape. Instead of changing the element itself, a mask controls
        which parts are visible (white = visible, black = hidden, transparent = partial).
        Masking is commonly used for creative image crops, fade effects, text reveals,
        and modern UI designs.
    </p>


    <!-- Basic Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector {<br>
            &nbsp;mask-image: url(mask.png);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            The mask image decides which parts of the element show or hide.
        </p>
    </div>



    <!-- Properties -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">mask-image</h4>
            <p class="text-sm mb-2">Defines the image or gradient used as a mask.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                mask-image: url("mask.png");
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">mask-size</h4>
            <p class="text-sm mb-2">Controls size of the masking image.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                mask-size: cover;
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">mask-repeat</h4>
            <p class="text-sm mb-2">Decides whether mask repeats or not.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                mask-repeat: no-repeat;
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">mask-position</h4>
            <p class="text-sm mb-2">Sets mask placement on the element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                mask-position: center;
            </code>
        </div>

    </div>



    <!-- Gradient Mask Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Gradient Mask Example (Fade Effect)</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .image {<br>
            &nbsp;mask-image: linear-gradient(to bottom, black, transparent);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            This creates a smooth fade-out effect from visible to transparent.
        </p>
    </div>



    <!-- Text Reveal Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Circle Reveal Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .box {<br>
            &nbsp;mask-image: radial-gradient(circle, black 60%, transparent 61%);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Shows only the circular area and hides the outside region.
        </p>
    </div>


    <!-- Important Note -->
    <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-xl mt-8 text-sm">
        <strong>Browser Tip:</strong> Some browsers (especially Safari/Chrome)
        may require <code>-webkit-mask-image</code> along with <code>mask-image</code>
        for full compatibility.
    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS 2D Transformations</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS 2D Transformations allow elements to move, rotate, resize, or skew
        on a two-dimensional plane (X and Y axis). These transformations are commonly
        used for hover effects, UI animations, interactive cards, and layout adjustments
        without changing the document flow.
    </p>


    <!-- Basic Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector {<br>
            &nbsp;transform: function(value);<br>
            }
        </code>

    </div>



    <!-- Transform Types -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- translate -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">translate(x, y)</h4>
            <p class="text-sm mb-2">Moves the element from its original position.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: translate(50px, 20px);
            </code>
        </div>

        <!-- translateX -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">translateX()</h4>
            <p class="text-sm mb-2">Moves element horizontally.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: translateX(100px);
            </code>
        </div>

        <!-- translateY -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">translateY()</h4>
            <p class="text-sm mb-2">Moves element vertically.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: translateY(50px);
            </code>
        </div>

        <!-- rotate -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">rotate(deg)</h4>
            <p class="text-sm mb-2">Rotates the element clockwise or counterclockwise.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: rotate(45deg);
            </code>
        </div>

        <!-- scale -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">scale(x, y)</h4>
            <p class="text-sm mb-2">Resizes the element bigger or smaller.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: scale(1.5);
            </code>
        </div>

        <!-- scaleX -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">scaleX()</h4>
            <p class="text-sm mb-2">Stretches element horizontally.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: scaleX(2);
            </code>
        </div>

        <!-- scaleY -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">scaleY()</h4>
            <p class="text-sm mb-2">Stretches element vertically.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: scaleY(2);
            </code>
        </div>

        <!-- skewX -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">skewX()</h4>
            <p class="text-sm mb-2">Tilts the element horizontally.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: skewX(20deg);
            </code>
        </div>

        <!-- skewY -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">skewY()</h4>
            <p class="text-sm mb-2">Tilts the element vertically.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: skewY(20deg);
            </code>
        </div>

    </div>



    <!-- Combine -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Combine Multiple Transformations</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            transform: translateX(50px) rotate(30deg) scale(1.2);
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Multiple transform functions can be used together in one line.
        </p>
    </div>



    <!-- Hover Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Hover Animation Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .card {<br>
            &nbsp;transition: 0.3s;<br>
            }<br><br>

            .card:hover {<br>
            &nbsp;transform: scale(1.1) rotate(2deg);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            On hover, the element slightly grows and rotates smoothly.
        </p>
    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS 3D Transformations</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS 3D Transforms allow elements to move, rotate, and scale in three-dimensional
        space using the X, Y, and Z axes. Unlike 2D transforms, 3D transforms can create
        depth, perspective, and realistic motion effects. They are widely used for card flips,
        3D buttons, sliders, galleries, and interactive UI components.
    </p>


    <!-- Basic Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector {<br>
            &nbsp;transform: rotateX(45deg);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            3D transforms use the same <code>transform</code> property but include depth (Z-axis).
        </p>
    </div>



    <!-- Transform Functions -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- rotateX -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">rotateX(deg)</h4>
            <p class="text-sm mb-2">Rotates element around the horizontal X-axis.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: rotateX(60deg);
            </code>
        </div>

        <!-- rotateY -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">rotateY(deg)</h4>
            <p class="text-sm mb-2">Rotates element around the vertical Y-axis.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: rotateY(60deg);
            </code>
        </div>

        <!-- rotateZ -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">rotateZ(deg)</h4>
            <p class="text-sm mb-2">Rotates element on the Z-axis (same as normal rotate).</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: rotateZ(30deg);
            </code>
        </div>

        <!-- translateZ -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">translateZ(px)</h4>
            <p class="text-sm mb-2">Moves element closer or farther from the viewer.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: translateZ(100px);
            </code>
        </div>

        <!-- scaleZ -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">scale3d()</h4>
            <p class="text-sm mb-2">Scales element across X, Y, and Z axes.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: scale3d(1.2,1.2,1.2);
            </code>
        </div>

        <!-- matrix3d -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">matrix3d()</h4>
            <p class="text-sm mb-2">Advanced 3D transform using mathematical matrix values.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                transform: matrix3d(...);
            </code>
        </div>

    </div>



    <!-- Perspective -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Perspective (Creates Depth)</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .container {<br>
            &nbsp;perspective: 800px;<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Perspective controls how strong the 3D effect appears.
            Smaller value = stronger depth, larger value = flatter look.
        </p>
    </div>



    <!-- Preserve 3D -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">preserve-3d</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .parent {<br>
            &nbsp;transform-style: preserve-3d;<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Keeps child elements positioned in 3D space instead of flattening them.
        </p>
    </div>



    <!-- Card Flip Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">3D Card Flip Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .card {<br>
            &nbsp;transition: 0.6s;<br>
            &nbsp;transform-style: preserve-3d;<br>
            }<br><br>

            .card:hover {<br>
            &nbsp;transform: rotateY(180deg);<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            On hover, the card flips in 3D space creating a realistic flip animation.
        </p>
    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Media Queries</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        A Media Query in CSS allows styles to be applied only when certain conditions
        are true — such as screen width, height, device orientation, resolution, or
        output type (screen or print). Media queries are the core tool used for
        Responsive Web Design (RWD), helping websites adapt to mobiles, tablets,
        laptops, and large screens.
    </p>


    <!-- Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            @media (condition) {<br>
            &nbsp;selector {<br>
            &nbsp;&nbsp;property: value;<br>
            &nbsp;}<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Styles inside the media query will only work when the condition becomes true.
        </p>
    </div>



    <!-- Media Types -->
    <h3 class="text-xl font-semibold mb-4">Media Types</h3>

    <div class="grid sm:grid-cols-2 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">screen</h4>
            <p class="text-sm mb-2">Used for phones, tablets, laptops, and monitors.</p>

            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media screen and (max-width: 600px) {<br>
                &nbsp;body { font-size:14px; }<br>
                }
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">print</h4>
            <p class="text-sm mb-2">Applies styles when the page is printed.</p>

            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media print {<br>
                &nbsp;body { color:black; }<br>
                }
            </code>
        </div>

    </div>



    <!-- Common Conditions -->
    <h3 class="text-xl font-semibold mb-4">Common Conditions</h3>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">max-width</h4>
            <p class="text-sm mb-2">Applies styles for smaller screens.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media (max-width:768px){}
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">min-width</h4>
            <p class="text-sm mb-2">Applies styles for larger screens.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media (min-width:1024px){}
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">orientation</h4>
            <p class="text-sm mb-2">Detects portrait or landscape mode.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media (orientation: landscape){}
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">height</h4>
            <p class="text-sm mb-2">Checks screen height.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media (max-height:700px){}
            </code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold mb-1">resolution</h4>
            <p class="text-sm mb-2">Targets high-resolution displays.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                @media (min-resolution:2dppx){}
            </code>
        </div>

    </div>



    <!-- Real Responsive Example -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Real Responsive Example</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            /* Desktop */<br>
            .container { width:1200px; }<br><br>

            /* Tablet */<br>
            @media (max-width:992px){<br>
            &nbsp;.container{ width:90%; }<br>
            }<br><br>

            /* Mobile */<br>
            @media (max-width:600px){<br>
            &nbsp;.container{ width:100%; padding:10px; }<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            This example shows how layout changes automatically for desktop,
            tablet, and mobile screens.
        </p>
    </div>

</section>

<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Pseudo-Classes</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS pseudo-classes are keywords added to selectors that define a special
        state of an element. They allow styling based on user interaction,
        position in the document, or element condition — without using JavaScript.
        Commonly used for hover effects, form validation, navigation styling,
        and interactive UI behavior.
    </p>


    <!-- Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector:pseudo-class {<br>
            &nbsp;property:value;<br>
            }
        </code>

    </div>



    <!-- Interaction -->
    <h3 class="text-xl font-semibold mb-4">User Interaction Pseudo-Classes</h3>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:hover</h4>
            <p class="text-sm mb-2">Applies when mouse is over an element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">button:hover{ background:red; }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:active</h4>
            <p class="text-sm mb-2">Applies while an element is being clicked.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">button:active{ transform:scale(.95); }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:focus</h4>
            <p class="text-sm mb-2">Applies when input or element gets focus.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">input:focus{ border:2px solid blue; }</code>
        </div>

    </div>



    <!-- Form -->
    <h3 class="text-xl font-semibold mb-4">Form State Pseudo-Classes</h3>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:checked</h4>
            <p class="text-sm mb-2">Targets checked radio or checkbox.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">input:checked{ accent-color:green; }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:disabled</h4>
            <p class="text-sm mb-2">Targets disabled inputs or buttons.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">button:disabled{ opacity:.5; }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:required</h4>
            <p class="text-sm mb-2">Targets required form fields.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">input:required{ border-color:red; }</code>
        </div>

    </div>



    <!-- Position -->
    <h3 class="text-xl font-semibold mb-4">Structural / Position Pseudo-Classes</h3>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:first-child</h4>
            <p class="text-sm mb-2">Selects the first child element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">li:first-child{ color:red; }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:last-child</h4>
            <p class="text-sm mb-2">Selects the last child element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">li:last-child{ color:blue; }</code>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">:nth-child(n)</h4>
            <p class="text-sm mb-2">Selects element based on position number.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">tr:nth-child(even){ background:#eee; }</code>
        </div>

    </div>



    <!-- Link States -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Link State Order (Important)</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            a:link {}<br>
            a:visited {}<br>
            a:hover {}<br>
            a:active {}
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Remember the order: <strong>Link → Visited → Hover → Active</strong>.
            Wrong order may prevent styles from working correctly.
        </p>
    </div>

</section>
<section class="max-w-6xl mx-auto px-4 py-10">

    <h2 class="text-2xl md:text-3xl font-bold mb-3">CSS Pseudo-Elements</h2>

    <p class="text-gray-600 max-w-3xl mb-8">
        CSS pseudo-elements are used to style a specific part of an element,
        or to insert virtual content before or after it. Unlike pseudo-classes
        (which define a state), pseudo-elements target a portion of the element
        itself such as the first letter, first line, selected text, or generated content.
    </p>


    <!-- Syntax -->
    <div class="bg-white p-6 rounded-2xl shadow mb-8">
        <h3 class="font-semibold text-lg mb-2">Basic Syntax</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            selector::pseudo-element {<br>
            &nbsp;property:value;<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            Modern CSS uses a double colon (<code>::</code>) to distinguish pseudo-elements
            from pseudo-classes.
        </p>
    </div>



    <!-- Common pseudo elements -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- before -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::before</h4>
            <p class="text-sm mb-2">Inserts content before the element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                h1::before{ content:"★ "; }
            </code>
        </div>

        <!-- after -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::after</h4>
            <p class="text-sm mb-2">Inserts content after the element.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                h1::after{ content:" ✔"; }
            </code>
        </div>

        <!-- first-letter -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::first-letter</h4>
            <p class="text-sm mb-2">Styles the first letter of text.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                p::first-letter{ font-size:200%; }
            </code>
        </div>

        <!-- first-line -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::first-line</h4>
            <p class="text-sm mb-2">Styles the first line of a block.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                p::first-line{ color:blue; }
            </code>
        </div>

        <!-- selection -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::selection</h4>
            <p class="text-sm mb-2">Styles text selected by the user.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                ::selection{ background:yellow; }
            </code>
        </div>

        <!-- placeholder -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h4 class="font-semibold">::placeholder</h4>
            <p class="text-sm mb-2">Styles placeholder text in inputs.</p>
            <code class="bg-gray-100 p-2 rounded block text-sm">
                input::placeholder{ color:gray; }
            </code>
        </div>

    </div>



    <!-- Important rule -->
    <div class="bg-white p-6 rounded-2xl shadow mt-8">
        <h3 class="font-semibold text-lg mb-3">Important Rule (for before & after)</h3>

        <code class="bg-gray-100 p-3 rounded block text-sm">
            .box::before {<br>
            &nbsp;content:"Hello";<br>
            }
        </code>

        <p class="text-sm text-gray-600 mt-3">
            <strong>content</strong> property is required for <code>::before</code> and
            <code>::after</code>. Without it, the pseudo-element will not appear.
        </p>
    </div>



    <!-- Difference note -->
    <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-xl mt-8 text-sm">
        <strong>Quick Difference:</strong><br>
        Pseudo-class → defines element state (like <code>:hover</code>)<br>
        Pseudo-element → styles part of element (like <code>::first-letter</code>)
    </div>

</section>

</body>
</html>
