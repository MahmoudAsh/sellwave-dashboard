import * as Headless from '@headlessui/react'
import { clsx } from 'clsx'
import React from 'react'
import { Link } from './link'

const styles = {
  base: [
    // Base
    'relative isolate inline-flex items-center justify-center gap-x-2 rounded-lg border text-base/6 font-semibold',
    'px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] sm:px-[calc(theme(spacing.3)-1px)] sm:py-[calc(theme(spacing[1.5])-1px)] sm:text-sm/6',
    
    // Focus
    'focus:outline-none data-[focus]:outline data-[focus]:outline-2 data-[focus]:outline-offset-2 data-[focus]:outline-blue-500',
    
    // Disabled
    'data-[disabled]:opacity-50',
    'data-[disabled]:cursor-default',
    'data-[disabled]:pointer-events-none',
  ],
  solid: [
    'border-transparent bg-zinc-950 text-white',
    'data-[hover]:bg-zinc-800',
    'data-[active]:bg-zinc-800',
    'dark:bg-white dark:text-zinc-950',
    'dark:data-[hover]:bg-zinc-200',
    'dark:data-[active]:bg-zinc-200',
  ],
  outline: [
    'border-zinc-950/10 text-zinc-950',
    'data-[hover]:bg-zinc-950/[2.5%]',
    'data-[active]:bg-zinc-950/5',
    'dark:border-white/15 dark:text-white',
    'dark:data-[hover]:bg-white/[2.5%]',
    'dark:data-[active]:bg-white/5',
  ],
  plain: [
    'border-transparent text-zinc-950',
    'data-[hover]:bg-zinc-950/5',
    'data-[active]:bg-zinc-950/10',
    'dark:text-white',
    'dark:data-[hover]:bg-white/5',
    'dark:data-[active]:bg-white/10',
  ],
}

type ButtonProps = (
  | { color?: 'dark' | 'light'; outline?: never; plain?: never }
  | { color?: never; outline: true; plain?: never }
  | { color?: never; outline?: never; plain: true }
) & (
  | Omit<Headless.ButtonProps, 'className'>
  | (Omit<React.ComponentPropsWithoutRef<typeof Link>, 'className'> & { href: string })
) & {
  className?: string
}

export function Button({ color, outline, plain, className, ...props }: ButtonProps) {
  const classes = clsx(
    className,
    styles.base,
    outline
      ? styles.outline
      : plain
      ? styles.plain
      : styles.solid
  )

  return 'href' in props ? (
    <Link {...props} className={classes} />
  ) : (
    <Headless.Button {...props} className={classes} />
  )
} 