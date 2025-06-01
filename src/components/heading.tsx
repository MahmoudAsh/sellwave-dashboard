import { clsx } from 'clsx'
import React from 'react'

type HeadingProps = {
  level?: 1 | 2 | 3 | 4 | 5 | 6
  className?: string
  children: React.ReactNode
}

export function Heading({ level = 1, className, ...props }: HeadingProps) {
  let Element: `h${1 | 2 | 3 | 4 | 5 | 6}` = `h${level}`

  return (
    <Element
      {...props}
      className={clsx(
        className,
        'text-zinc-950 dark:text-white',
        level === 1 && 'text-2xl/8 font-semibold sm:text-xl/8',
        level === 2 && 'text-base/7 font-semibold sm:text-sm/6',
        level === 3 && 'text-base/7 font-semibold sm:text-sm/6',
        (level === 4 || level === 5 || level === 6) && 'text-base/7 font-semibold sm:text-sm/6'
      )}
    />
  )
} 