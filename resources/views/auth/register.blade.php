<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Komik Ku</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="flex flex-col justify-center items-center bg-white h-[100vh]">
        <div
            class="mx-auto flex w-full flex-col justify-center px-5 pt-0 md:h-[unset] md:max-w-[50%] lg:h-[100vh] min-h-[100vh] lg:max-w-[50%] lg:px-6">
            <a class="mt-10 w-fit text-zinc-950 dark:text-white" href="/">
                <div class="flex w-fit items-center lg:pl-0 lg:pt-0 xl:pt-0">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512"
                        class="mr-3 h-[13px] w-[8px] text-zinc-950 dark:text-white" height="1em" width="1em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z">
                        </path>
                    </svg>
                    <p class="ml-0 text-sm text-zinc-950 dark:text-white">Back to the website</p>
                </div>
            </a> 
            <div
                class="my-auto mb-auto mt-8 flex flex-col md:mt-[70px] w-[350px] max-w-[450px] mx-auto md:max-w-[450px] lg:mt-[130px] lg:max-w-[450px]">
                <p class="text-[32px] font-bold text-zinc-950 dark:text-white">Sign Up</p>
                <p class="mb-2.5 mt-2.5 font-normal text-zinc-950 dark:text-zinc-400">Enter your details to create an account!</p>
                <div class="relative my-4">
                    <div class="relative flex items-center py-1">
                        <div class="grow border-t border-zinc-200 dark:border-zinc-700"></div>
                        <div class="grow border-t border-zinc-200 dark:border-zinc-700"></div>
                    </div>
                </div>
                <div>
                    <form action="{{ route('register') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="grid gap-2">
                            <div class="grid gap-1">
                                <label class="text-zinc-950 dark:text-white" for="name">Name</label>
                                <input class="mr-2.5 mb-2 h-full min-h-[44px] w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-medium text-zinc-950 placeholder:text-zinc-400 focus:outline-0 dark:border-zinc-800 dark:bg-transparent dark:text-white dark:placeholder:text-zinc-400"
                                    id="name" placeholder="Full Name" type="text" name="name" required>
                                
                                <label class="text-zinc-950 dark:text-white" for="email">Email</label>
                                <input class="mr-2.5 mb-2 h-full min-h-[44px] w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-medium text-zinc-950 placeholder:text-zinc-400 focus:outline-0 dark:border-zinc-800 dark:bg-transparent dark:text-white dark:placeholder:text-zinc-400"
                                    id="email" placeholder="name@example.com" type="email" name="email" required>

                                <label class="text-zinc-950 dark:text-white" for="password">Password</label>
                                <input id="password" placeholder="Password" type="password"
                                    class="mr-2.5 mb-2 h-full min-h-[44px] w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-medium text-zinc-950 placeholder:text-zinc-400 focus:outline-0 dark:border-zinc-800 dark:bg-transparent dark:text-white dark:placeholder:text-zinc-400"
                                    name="password" required>
                                    
                                <label class="text-zinc-950 dark:text-white" for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" placeholder="Confirm Password" type="password"
                                    class="mr-2.5 mb-2 h-full min-h-[44px] w-full rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm font-medium text-zinc-950 placeholder:text-zinc-400 focus:outline-0 dark:border-zinc-800 dark:bg-transparent dark:text-white dark:placeholder:text-zinc-400"
                                    name="password_confirmation" required>
                            </div>
                            <button class="whitespace-nowrap ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-blue-700 text-white hover:bg-blue-800 mt-2 flex h-[unset] w-full items-center justify-center rounded-lg px-4 py-4 text-sm font-medium"
                                type="submit">
                                Sign up
                            </button>
                        </div>
                    </form>
                    <p><a href="{{ route('login') }}" class="font-medium text-zinc-950 dark:text-white text-sm">Already have an account? Sign in</a></p>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>